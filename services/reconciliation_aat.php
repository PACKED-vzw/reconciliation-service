<?php

//AAT

require_once (dirname(__FILE__) . '/reconciliation_api.php');


//--------------------------------------------------------------------------------------------------
class AatService extends ReconciliationService
{
    var $client;

    //----------------------------------------------------------------------------------------------
    function __construct()
    {
        $this->name 			= 'AAT';

        // Freebase has a namespace for VIAF
        // https://www.freebase.com/user/hangy/viaf
        $this->identifierSpace 	= 'http://rdf.freebase.com/ns/user/hangy/viaf';

        // Freebase object
        $this->schemaSpace 		= 'http://rdf.freebase.com/ns/type.object.id';

        $this->Types();

        $view_url = 'http://viaf.org/viaf/{{id}}';

        $preview_url = '';
        $width = 430;
        $height = 300;

        if ($view_url != '')
        {
            $this->View($view_url);
        }
        if ($preview_url != '')
        {
            $this->Preview($preview_url, $width, $height);
        }
    }

    //----------------------------------------------------------------------------------------------
    function Types()
    {
        $type = new stdclass;
        $type->id = '/objectname';
        $type->name = 'Objectname';
        $this->defaultTypes[] = $type;
    }




    //----------------------------------------------------------------------------------------------
    // Handle an individual query
    function OneQuery($query_key, $text, $limit = 1)
    {
        $url = 'http://viaf.org/viaf/search?query=' . urlencode('local.personalNames all ' . $text)
            . '&httpAccept=' . urlencode('application/rss+xml');


        //$url = 'http://viaf.org/viaf/AutoSuggest?query=' . urlencode($text);

        //echo $url . "\n";

        $this->writeIt($url, 'url');
        $xml = file_get_contents($url);

        //echo $xml;
        $this->writeIt($xml, 'xml');
        if ($xml != '')
        {
            $dom= new DOMDocument;
            $dom->loadXML($xml);
            $xpath = new DOMXPath($dom);

            $xpath->registerNamespace('opensearch', 'http://a9.com/-/spec/opensearch/1.1/');

            $xpath_query = "//opensearch:totalResults";

            $count = 0;

            $nodeCollection = $xpath->query ($xpath_query);
            foreach($nodeCollection as $node)
            {
                $count = $node->firstChild->nodeValue;
            }

            if ($count > 0)
            {
                $xpath_query = "//item/title";
                $nodeCollection = $xpath->query ($xpath_query);
                foreach($nodeCollection as $node)
                {
                    $hit = new stdclass;
                    $hit->score = 1;
                    $hit->match = ($count == 1);
                    $hit->name 	= $node->firstChild->nodeValue;

                    $nc = $xpath->query ('../guid', $node);
                    foreach($nc as $n)
                    {
                        $hit->id = str_replace('http://viaf.org/viaf/', '', $n->firstChild->nodeValue);
                    }
                    $this->writeIt($query_key, 'querykey');
                    $this->writeIt($hit, 'hit');
                    $this->StoreHit($query_key, $hit);
                }
            }
        }


    }

}


?>