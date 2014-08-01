<?php
/**
 * EasyWsdl2PHP.php
 *
 * A modified version of http://sourceforge.net/projects/easywsdl2php
 * for Yii gii extension wsdl2php
 *
 * PHP version 5.2+
 *
 * @author Joe Blocher <yii@myticket.at>
 * @copyright 2011 myticket it-solutions gmbh
 * @license New BSD License
 * @package wsdl2php
 * @version 0.5
 */
class EasyWsdl2PHP
{

    /**
     * Generate the classes for the client
     *
     * @param string $url
     * @param string $sname
     * @param string $clientClassExtends
     * @param string $paramClassExtends
     * @param string $addStaticModelFunction (unused for this extension)
     * @return string
     */
    static public function generate($url,$sname,$clientClassExtends=null,$paramClassExtends=null,$addStaticModelFunction = false)
    {
    	ini_set ('soap.wsdl_cache_enabled',0);
    	 
        $soapClient       = new SoapClient($url);
        $classesArr = array();

        $functions = $soapClient->__getFunctions();

        $nl="\n";
        $tab="\t";

        $code ='';
        $simpletypes = array('string','int','double','dateTime','float');

    	//workaround by joblo: sometimes multiple functions with the same name
    	$registeredFunctions = array();

        foreach($functions as $func)
        if (!in_array($func,$registeredFunctions))
        {
            $registeredFunctions[] = $func;

			$temp = explode(' ' ,$func,2);
            //less process whateever is inside ()
            $start = strpos($temp[1],'(');
            $end = strpos($temp[1],'(');
            $parameters = substr($temp[1],$start,$end);


            $t1 = str_replace(')','',$temp[1]);
            $t1 = str_replace('(',':',$t1);
            $t2 = explode(':',$t1);
            $func = $t2[0];
            $par = $t2[1];

            $params = explode(' ', $par);
            $p1 = '$' . $params[0];


            $code .= $nl . $nl .'function ' . $func . '(' . $p1 .')'
            . "{$nl}{";
            if ($temp[0] == 'void')
                $code .=  $nl ."\t\$this->soapClient->$func({$p1});{$nl}}";
            else
            {
                $code .=  $nl . $tab . '$' . $temp[0] . ' = ' .  "\$this->soapClient->$func({$p1});";
                $code .= $nl ."\treturn \${$temp[0]};{$nl}}";
            }
        }

        $code .= $nl . "}\n{$nl}";

        //    print_r($functions);
        //    echo "<hr>";
        $types = $soapClient->__getTypes();
        // print_r($types);
        $codeType ='';
        foreach ($types as $type)
        {
            if (substr($type,0,6) == 'struct')
            {
                $data = trim(str_replace(array('{','}'),'',substr($type,strpos($type, '{')+1)));
                $data_members = explode(';',$data);
                //print_r($data_members);
                // echo "[" . $data . "]";
                $classname = trim(substr($type,6,strpos($type,'{')-6));

            	$extends = !empty($paramClassExtends) ? ' extends '. $paramClassExtends : '';
                //write object
                $codeType .= $nl . $nl . 'class ' . $classname .$extends . $nl . '{';

                $classesArr [] = $classname;
                foreach($data_members as $member)
                {
                    $member = trim($member);
                    if (strlen($member)< 1) continue;
                    list($data_type,$member_name) = explode(' ' , $member);
                    $codeType .= $nl . <<< EOT
public \${$member_name}; //{$data_type};
EOT;
                }

            	if ($addStaticModelFunction)
            	{
            		$modelFunction = <<< EOT

/**
* Returns the static model of the specified AR class.
*/
public static function model(\$className = __CLASS__)
{
return parent::model(\$className);
}

EOT;
            	   $codeType .= $nl . $modelFunction .  $nl .'}';
	}
            	else
                   $codeType .= $nl .'}';
            }
        }

        $mapstr = "\n\t" . 'private static $classmap = array(' . $nl;
        $classMAPCode = array();
        foreach($classesArr as $cname)
        {
            // $mapstr .= "\n,'$cname'=>'$cname'";
            $classMAPCode[] = "\t\t'$cname'=>'$cname',\n";
        }
        //print_r($classMAPCode);
        $mapstr .= implode ('',$classMAPCode);
        $mapstr .= "\n);";

    	$extends = !empty($clientClassExtends) ? ' extends '. $clientClassExtends : '';

        $fullcode = <<< EOT
<?php
/**
* Soap client $sname
*
* Autogenerated with the Yii extension wsdl2php.
*/

$codeType

/**
* The soap client proxy class
*/
class $sname$extends $nl {
\tpublic \$soapClient;
$mapstr

function __construct(\$url='{$url}')
{
\$this->soapClient = new SoapClient(\$url,array("classmap"=>self::\$classmap,"trace" => true,"exceptions" => true));
}
$code

EOT;

        return $fullcode;
    }

}
