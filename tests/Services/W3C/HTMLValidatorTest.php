<?php
// Call Services_W3C_HTMLValidatorTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Services_W3C_HTMLValidatorTest::main");
}

require_once "PHPUnit/Framework/TestCase.php";
require_once "PHPUnit/Framework/TestSuite.php";

require_once 'Services/W3C/HTMLValidator.php';

/**
 * Test class for Services_W3C_HTMLValidator.
 * Generated by PHPUnit_Util_Skeleton on 2007-04-09 at 10:51:02.
 */
class Services_W3C_HTMLValidatorTest extends PHPUnit_Framework_TestCase {
    /**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main() {
        require_once "PHPUnit/TextUI/TestRunner.php";

        $suite  = new PHPUnit_Framework_TestSuite("Services_W3C_HTMLValidatorTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @access protected
     */
    protected function setUp() {
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     *
     * @access protected
     */
    protected function tearDown() {
    }

    /**
     * @todo Implement testSetOptions().
     */
    public function testSetOptions() {
        $test = new Services_W3C_HTMLValidator(array('uri'=>'foo','validator_uri'=>'bar'));
        // Test that value was set.
        $this->assertEquals($test->uri,'foo');
        $this->assertEquals($test->validator_uri,'bar');
    }

    /**
     * @todo Implement testValidate().
     */
    public function testValidate() {
        $uri = 'http://www.unl.edu/';
        $v = new Services_W3C_HTMLValidator();
        $r = $v->validate($uri);
        $this->assertEquals(get_class($r),'Services_W3C_HTMLValidator_Response');
        $this->assertEquals($r->isValid(),true);
        $this->assertEquals(count($r->errors),0);
        $this->assertEquals($r->uri,$uri);
        $this->assertEquals($r->checkedby.'check',$v->validator_uri);
    }

    /**
     * @todo Implement testValidateFile().
     */
    public function testValidateFile() {
        $v = new Services_W3C_HTMLValidator();
        $doc_dir = exec('pear config-get doc_dir');
        $file = '/Services_W3C_HTMLValidator/docs/examples/example.html';
        $r = $v->validateFile($doc_dir.$file);
        $this->assertEquals(get_class($r),'Services_W3C_HTMLValidator_Response');
        $this->assertEquals($r->isValid(),false);
        $this->assertEquals($r->charset,'utf-8');
        $this->assertEquals(count($r->errors),12);
        $this->assertEquals(get_class($r->errors[0]),'Services_W3C_HTMLValidator_Error');
    }

    /**
     * @todo Implement testValidateFragment().
     */
    public function testValidateFragment() {
        $v = new Services_W3C_HTMLValidator();
        $r = $v->validateFragment('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head><title>HTML Fragment</title></head>
    <body><p>TEST!</p></body>
</html>');
        $this->assertEquals(get_class($r),'Services_W3C_HTMLValidator_Response');
        $this->assertEquals($r->isValid(),true);
        $this->assertEquals($r->charset,'utf-8');
        $this->assertEquals($r->uri,'upload://Form Submission');
    }

    /**
     * @todo Implement testParseSOAP12Response().
     */
    public function testParseSOAP12Response() {
        $v = new Services_W3C_HTMLValidator();
        $r = $v->parseSOAP12Response('<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope">
<env:Body>
<m:markupvalidationresponse
env:encodingStyle="http://www.w3.org/2003/05/soap-encoding" 
xmlns:m="http://www.w3.org/2005/10/markup-validator">
    <m:uri>http://qa-dev.w3.org/wmvs/HEAD/dev/tests/xhtml1-bogus-element.html</m:uri>
    <m:checkedby>http://validator.w3.org/</m:checkedby>
    <m:doctype>-//W3C//DTD XHTML 1.0 Transitional//EN</m:doctype>
    <m:charset>utf-8</m:charset>
    <m:validity>false</m:validity>
    <m:errors>
        <m:errorcount>1</m:errorcount>
        <m:errorlist>
          
            <m:error>
                <m:line>13</m:line>
                <m:col>6</m:col>                                           
                <m:message>element "foo" undefined</m:message>
            </m:error>
           
        </m:errorlist>
    </m:errors>
    <m:warnings>
        <m:warningcount>0</m:warningcount>
        <m:warninglist>
        
        
        </m:warninglist>
    </m:warnings>
</m:markupvalidationresponse>
</env:Body>
</env:Envelope>
');
        $this->assertEquals(get_class($r),'Services_W3C_HTMLValidator_Response');
        $this->assertEquals(serialize($r),'O:35:"Services_W3C_HTMLValidator_Response":7:{s:3:"uri";s:66:"http://qa-dev.w3.org/wmvs/HEAD/dev/tests/xhtml1-bogus-element.html";s:9:"checkedby";s:24:"http://validator.w3.org/";s:7:"doctype";s:38:"-//W3C//DTD XHTML 1.0 Transitional//EN";s:7:"charset";s:5:"utf-8";s:8:"validity";b:0;s:6:"errors";a:1:{i:0;O:32:"Services_W3C_HTMLValidator_Error":4:{s:4:"line";s:2:"13";s:3:"col";s:1:"6";s:7:"message";s:23:"element "foo" undefined";s:9:"messageid";N;}}s:8:"warnings";a:0:{}}');
    }
}

// Call Services_W3C_HTMLValidatorTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Services_W3C_HTMLValidatorTest::main") {
    Services_W3C_HTMLValidatorTest::main();
}
?>
