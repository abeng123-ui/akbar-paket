<?php
class PackageTest extends TestCase
{
    public function testGetListPackage(){
        $this->get('package',[]);
        $this->seeStatusCode(200);
        $this->seeJson(['error'=>false]);
    }

    public function testGetListPackageByTransactionId(){
        $this->get('package/1',[]);
        $this->seeStatusCode(200);
        $this->seeJson(['error'=>false]);
    }

}
