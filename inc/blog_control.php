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
     * @return false|array returns false if an error occurred or the return form database is empty,
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
            $categories = $this->db->getAllCategoriesToBlog($allBlogs[$i]["id"]);

            if ($comments != false) {
                // puts all comments form database in to returnData
                $returnData[$i]["comments"] = $comments;
                // formats date to be ready to print
                for ($j=0; $j < count($returnData[$i]["comments"]); $j++) { 
                    $returnData[$i]["comments"][$j]["timestamp"] = date("h:i d/m/Y", strtotime($returnData[$i]["comments"][$j]["timestamp"]));
                }
            } 
            else $returnData[$i]["comments"] = false;

            if ($categories != false) {
                // puts all categories form database in to returnData
                $returnData[$i]["categories"] = $categories;
            } 
            else $returnData[$i]["categories"] = false;
        }
        

        if (count($returnData) != 0) return $returnData;
        else return false;
    }

    /**
     * gets only one blog form database 
     * 
     * @param string $blogId id of blog to get
     * 
     * @return false|array returns false if an error occurred or the return form database is empty,
     * returns array if database return is one or more items
     */
    public function getBlog(string $blogId)
    {
        // get all blogs in database
        $blogs = $this->getAllBlogs();

        for ($i=0; $i < count($blogs); $i++) { 
            // finds the width the id of the blog and returns 
            if ($blogs[$i]["id"] == $blogId) return $blogs[$i];
        }
        return false;
    }
}