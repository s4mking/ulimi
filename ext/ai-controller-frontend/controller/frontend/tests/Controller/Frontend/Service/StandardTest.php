<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2018
 */


namespace Aimeos\Controller\Frontend\Service;


class StandardTest extends \PHPUnit\Framework\TestCase
{
	private $object;
	private $context;
	private static $basket;


	protected function setUp()
	{
		\Aimeos\MShop::cache( true );

		$this->context = \TestHelperFrontend::getContext();
		$this->object = new \Aimeos\Controller\Frontend\Service\Standard( $this->context );
	}


	public static function setUpBeforeClass()
	{
		$orderManager = \Aimeos\MShop\Order\Manager\Factory::create( \TestHelperFrontend::getContext() );
		$orderBaseMgr = $orderManager->getSubManager( 'base' );
		self::$basket = $orderBaseMgr->createItem();
	}


	protected function tearDown()
	{
		\Aimeos\MShop::cache( false );
		unset( $this->object, $this->context );
	}


	public function testCompare()
	{
		$this->assertEquals( 1, count( $this->object->compare( '==', 'service.type', 'delivery' )->search() ) );
	}


	public function testFind()
	{
		$item = $this->object->uses( ['price'] )->find( 'unitcode' );

		$this->assertInstanceOf( \Aimeos\MShop\Service\Item\Iface::class, $item );
		$this->assertEquals( 2, count( $item->getRefItems( 'price' ) ) );
	}


	public function testGet()
	{
		$item = $this->object->uses( ['price'] )->get( $this->getServiceItem()->getId() );

		$this->assertInstanceOf( \Aimeos\MShop\Service\Item\Iface::class, $item );
		$this->assertEquals( 2, count( $item->getRefItems( 'price' ) ) );
	}


	public function testGetProvider()
	{
		$provider = $this->object->getProvider( $this->getServiceItem()->getId() );
		$this->assertInstanceOf( \Aimeos\MShop\Service\Provider\Iface::class, $provider );
	}


	public function testGetProviders()
	{
		$providers = $this->object->getProviders( 'delivery' );
		$this->assertGreaterThan( 0, count( $providers ) );

		foreach( $providers as $provider ) {
			$this->assertInstanceOf( \Aimeos\MShop\Service\Provider\Iface::class, $provider );
		}
	}


	public function testParse()
	{
		$cond = ['&&' => [['>' => ['service.status' => 0]], ['==' => ['service.type' => 'delivery']]]];
		$this->assertEquals( 1, count( $this->object->parse( $cond )->search() ) );
	}


	public function testProcess()
	{
		$form = new \Aimeos\MShop\Common\Helper\Form\Standard();
		$item = \Aimeos\MShop::create( $this->context, 'order' )->createItem();
		$serviceId = \Aimeos\MShop::create( $this->context, 'service' )->findItem( 'unitcode' )->getId();

		$provider = $this->getMockBuilder( \Aimeos\MShop\Service\Provider\Delivery\Standard::class )
			->disableOriginalConstructor()
			->setMethods( ['process'] )
			->getMock();

		$manager = $this->getMockBuilder( \Aimeos\MShop\Service\Manager\Standard::class )
			->setConstructorArgs( [$this->context] )
			->setMethods( ['getProvider'] )
			->getMock();

		\Aimeos\MShop::inject( 'service', $manager );

		$manager->expects( $this->once() )->method( 'getProvider' )->will( $this->returnValue( $provider ) );
		$provider->expects( $this->once() )->method( 'process' )->will( $this->returnValue( $form ) );


		$object = new \Aimeos\Controller\Frontend\Service\Standard( $this->context );
		$result = $object->process( $item, $serviceId, [], [] );

		$this->assertInstanceOf( \Aimeos\MShop\Common\Helper\Form\Iface::class, $result );
	}


	public function testSearch()
	{
		$total = 0;
		$items = $this->object->uses( ['price'] )->type( 'delivery' )->search( $total );

		$this->assertEquals( 1, count( $items ) );
		$this->assertEquals( 1, $total );
		$this->assertEquals( 2, count( current( $items )->getRefItems( 'price' ) ) );
	}


	public function testSlice()
	{
		$this->assertEquals( 2, count( $this->object->slice( 0, 2 )->search() ) );
	}


	public function testSort()
	{
		$this->assertEquals( 4, count( $this->object->sort( 'type' )->search() ) );
	}


	public function testSortGeneric()
	{
		$this->assertEquals( 4, count( $this->object->sort( 'service.status' )->search() ) );
	}


	public function testSortType()
	{
		$result = $this->object->sort( 'type' )->search();
		$this->assertEquals( 'unitcode', current( $result )->getCode() );
	}


	public function testSortTypeDesc()
	{
		$result = $this->object->sort( '-type' )->search();
		$this->assertStringStartsWith( 'unitpaymentcode', current( $result )->getCode() );
	}


	public function testUpdatePush()
	{
		$request = $this->getMockBuilder( \Psr\Http\Message\ServerRequestInterface::class )->getMock();
		$response = $this->getMockBuilder( \Psr\Http\Message\ResponseInterface::class )->getMock();

		$response->expects( $this->once() )->method( 'withStatus' )->will( $this->returnValue( $response ) );

		$this->assertInstanceOf( \Psr\Http\Message\ResponseInterface::class, $this->object->updatePush( $request, $response, 'unitcode' ) );
	}


	public function testUpdateSync()
	{
		$item = \Aimeos\MShop::create( $this->context, 'order' )->createItem();
		$request = $this->getMockBuilder( \Psr\Http\Message\ServerRequestInterface::class )->getMock();

		$provider = $this->getMockBuilder( '\\Aimeos\\MShop\\Service\\Provider\\Delivery\\Standard' )
			->setMethods( ['updateSync', 'query', 'isImplemented'] )
			->disableOriginalConstructor()
			->getMock();

		$orderManager = $this->getMockBuilder( '\\Aimeos\\MShop\\Order\\Manager\\Standard' )
			->setConstructorArgs( array( $this->context ) )
			->setMethods( ['getItem'] )
			->getMock();

		$serviceManager = $this->getMockBuilder( '\\Aimeos\\MShop\\Service\\Manager\\Standard' )
			->setConstructorArgs( array( $this->context ) )
			->setMethods( ['getProvider'] )
			->getMock();

		\Aimeos\MShop::inject( 'order', $orderManager );
		\Aimeos\MShop::inject( 'service', $serviceManager );


		$orderManager->expects( $this->once() )->method( 'getItem' )->will( $this->returnValue( $item ) );
		$serviceManager->expects( $this->once() )->method( 'getProvider' )->will( $this->returnValue( $provider ) );
		$provider->expects( $this->once() )->method( 'updateSync' )->will( $this->returnValue( $item ) );
		$provider->expects( $this->once() )->method( 'isImplemented' )->will( $this->returnValue( true ) );
		$provider->expects( $this->once() )->method( 'query' );


		$object = new \Aimeos\Controller\Frontend\Service\Standard( $this->context );
		$object->updateSync( $request, 'unitcode', -1 );
	}


	public function testUses()
	{
		$this->assertSame( $this->object, $this->object->uses( ['text'] ) );
	}


	/**
	 * @return \Aimeos\MShop\Service\Item\Iface
	 */
	protected function getServiceItem()
	{
		$manager = \Aimeos\MShop\Service\Manager\Factory::create( \TestHelperFrontend::getContext() );
		return $manager->findItem( 'unitcode' );
	}
}
