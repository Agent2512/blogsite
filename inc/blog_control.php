<?php
class blog_control
{
    private $db;

    public function __construct()
    {
        $this->db = new db_functions();
    }

    /**
     * gets all blogs form database
     * 
     * @return false|array returns false if an error occurred or the request is empty,
     * returns array if database return is one or more items
     */
    public function getAllBlogs()
    {
        // the array that is going to be returned
        $returnData = array();
        // all blog form database
        $allBlogs = $this->db->getAllBlogs();

        for ($i=0; $i < count($allBlogs); $i++) { 
            // puts all blog form database in to returnData
            array_push($returnData, $allBlogs[$i]);
            // gets all comments to blog form database
            $comments = $this->db->getAllCommentsToBlog($allBlogs[$i]["id"]);

            if ($comments != false) {
                // puts all comments form database in to returnData
                $returnData[$i]["comments"] = $comments;
                // formats date to ready to print
                for ($j=0; $j < count($returnData[$i]["comments"]); $j++) { 
                    $returnData[$i]["comments"][$j]["timestamp"] = date("h:i d/m/Y", strtotime($returnData[$i]["comments"][$j]["timestamp"]));
                }
            }

        }
        

        return $returnData;
    }

    /**
     * gets only one blog form database 
     * 
     * @param string $blogId id of blog to get
     * 
     * @return false|array returns false if an error occurred or the request is empty,
     * returns array if database return is one or more items
     */
    public function getBlog(string $blogId)
    {
        # code...
    }
}
