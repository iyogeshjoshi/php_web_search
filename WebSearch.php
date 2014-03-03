
/**
 * Returns rank and successful hits in result base on query and site provided
 *
 * @author yogesh.joshi
 */
 
class WebSearch
{
    // query to be searched
    public $query = "";
    // site whose rank is checking
    public $site = "";
    // start from which number of returned result
    public $startIndex = 0;
    // limit search upto what number
    public $num = 10;

    /**
     * Executes and returns rank and number of time that site appears
     * 
     * @param string $query Query to be searched
     * @param string $site name of the site eg., www.example.com
     * @return Array returns rank and number of hits in results
     */
    function execute($query = NULL, $site = NULL)
    {
        if(!empty($query))
            $this->query = $query;
        // make query to be executed by replading ' ' space with '+'
        $cleanQuery = str_replace(" ", "+", $this->query);
        
        // initialize variables
        if (!empty($site))
            $this->site = $site;
        else
            $site = $this->site;
        $startIndex = $this->startIndex;
        $num = $this->num;
        
        // initialize return vars
        $rank = NULL;
        $count = 0;
        
        // get query result from google
        $results = file_get_contents("http://www.google.com/search?q=$cleanQuery&start=$startIndex&num=$num");
        // remove all '&' or else it will throw error of 'entity'
        $results = str_replace('&', "", $results);

        // DOM Parser
        $dom = new DOMDocument();
        
        // parse result to HTML elements
        $dom->loadHTML($results);
        
        // get all links in the page
        $body = $dom->getElementsByTagName('cite');
        
        // if any result found
        if ($body)
        {
            // for each result
            for ($i = 0; $i < $body->length; $i++)
            {
                // get result url
                $cite = $body->item($i)->nodeValue;
                
                // prints each link returned in results
//                var_dump($body->item($i)->nodeValue . "\n");

                // match for site
                if (preg_match("/$site/", $cite))
                {
                    // increment count for each encounter
                    $count++;
                    // store the first hit
                    if (empty($rank))
                        $rank = $i + 1;
                }
            }
        }
        
        // return rank and number of hits respectively
        return array("rank" => $rank, "counts" => $count);
    }

}
