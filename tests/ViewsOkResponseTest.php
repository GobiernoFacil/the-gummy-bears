<?php

class ViewsOkResponseTest extends TestCase{

  public $provider = "SCM9209077V7";
  public $year     = 2016;
  public $contract = "OCDS-87SD3T-SEFIN-AD-SF-DRM-004-2015";
  
  // test home page
  public function testHomePage(){
    $this->call('GET', '/');
    $this->assertResponseOk();
  }

  public function testContractsLandingPage(){
    $this->call('GET', 'v2');
    $this->assertResponseOk();
  }
  
  public function testSearchPage(){
    $this->call('GET', 'contratos/busqueda');
    $this->assertResponseOk();
  }

  public function testContractsListPage(){
    $this->call('GET', 'contratos');
    $this->assertResponseOk();
  }

  public function testDependenciesListPage(){
    $this->call('GET', 'dependencias');
    $this->assertResponseOk();
  }

  public function testProvidersListPage(){
    $this->call('GET', 'proveedores');
    $this->assertResponseOk();
  }

  public function testProviderPage(){
    $this->call('GET', 'proveedor/' . $this->provider);
    $this->assertResponseOk();
  }

  public function testAboutPage(){
    $this->call('GET', 'por-que');
    $this->assertResponseOk();
  }

  public function testOpenDataPage(){
    $this->call('GET', 'datos-abiertos');
    $this->assertResponseOk();
  }

  public function testOpenDataContractsApiDocs(){
    $this->call('GET', 'datos-abiertos/documentacion-api-contratos');
    $this->assertResponseOk();
  }

  public function testOpenDataProvidersApiDocs(){
    $this->call('GET', 'datos-abiertos/documentacion-api-proveedores');
    $this->assertResponseOk();
  }

  public function testOpenDataBuyersApiDocs(){
    $this->call('GET', 'datos-abiertos/documentacion-api-dependencias');
    $this->assertResponseOk();
  }

  public function testOpenDataTendersApiDocs(){
    $this->call('GET', 'datos-abiertos/documentacion-api-licitaciones');
    $this->assertResponseOk();
  }

  public function testContactPage(){
    $this->call('GET', 'contacto');
    $this->assertResponseOk();
  }

  public function testTermsPage(){
    $this->call('GET', 'privacidad');
    $this->assertResponseOk();
  }

  public function testGlossaryPage(){
    $this->call('GET', 'glosario');
    $this->assertResponseOk();
  }

  public function testApiLandingPage(){
    $this->call('GET', 'api');
    $this->assertResponseOk();
  }

  public function testApiCallContractsAll(){
    $this->call('GET', 'api/contratos/todos');
    $this->assertResponseOk();
  }

  public function testApiCallContractsByYear(){
    $this->call('GET', 'api/contratos/ejercicio/' . $this->year);
    $this->assertResponseOk();
  }

  public function testApiCallProvidersAll(){
    $this->call('GET', 'api/proveedores/todos');
    $this->assertResponseOk();
  }

  public function testApiCallProviderById(){
    $this->call('GET', 'api/proveedor/' . $this->provider);
    $this->assertResponseOk();
  }

  public function testApiCallSearchContract(){
    $this->call('GET', 'api/contratos/buscar');
    $this->assertResponseOk();
  }

  public function testApiCallContractByOcid(){
    $this->call('GET', 'api/contrato/' . $this->contract);
    $this->assertResponseOk();
  }

  public function testApiCallContractData(){
    $this->call('GET', 'api/contrato/historico/' . $this->contract);
    $this->assertResponseOk();
  }

  public function testApiCallContractCurrent(){
    $this->call('GET', 'api/contrato/actual/' . $this->contract);
    $this->assertResponseOk();
  }

  public function testApiCallBuyersAll(){
    $this->call('GET', 'api/dependencias/todas');
    $this->assertResponseOk();
  }

  public function testApiCallBuyerProviderRelation(){
    $this->call('GET', 'api/dependencia-proveedor');
    $this->assertResponseOk();
  }

  public function testApiCallTenders(){
    $this->call('GET', 'api/licitaciones');
    $this->assertResponseOk();
  }
}