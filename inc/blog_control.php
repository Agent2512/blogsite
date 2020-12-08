<?php
class blog_control
{
    private $db;

    public function __construct()
    {
        $this->db = new db_functions();
    }

    private function processComments(string $blogId)
    {
        $comments = $this->db->getAllCommentsToBlog($blogId);

        if ($comments != false) {
            for ($i = 0; $i < count($comments); $i++) {
                $comments[$i]["timestamp"] = date("h:i d/m/Y", strtotime($comments[$i]["timestamp"]));
            }

            return $comments;
        } else return false;
    }

    public function processCategories(string $blogId)
    {
        $categories = $this->db->getAllCategoriesToBlog($blogId);

        if ($categories != false) return $categories;
        else return false;
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

        if ($allBlogs != false) for ($i = 0; $i < count($allBlogs); $i++) {
            // puts all blog form database in to returnData
            array_push($returnData, $allBlogs[$i]);
            // process blog
            // formats date to be ready to print on blog
            $returnData[$i]["timestamp"] = date("h:i d/m/Y", strtotime($returnData[$i]["timestamp"]));
            // process comments
            $returnData[$i]["comments"] = $this->processComments($returnData[$i]["id"]);
            if ($returnData[$i]["comments"] != false)  $returnData[$i]["commentsCount"] = count($returnData[$i]["comments"]);
            else $returnData[$i]["commentsCount"] = 0;

            // process categories
            $returnData[$i]["categories"] = $this->processCategories($returnData[$i]["id"]);
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
        $blog = $this->db->getBlogById($blogId);

        if ($blog != false) {
            $blog["timestamp"] = date("h:i d/m/Y", strtotime($blog["timestamp"]));
            // process comments
            $blog["comments"] = $this->processComments($blog["id"]);
            if ($blog["comments"] != false)  $blog["commentsCount"] = count($blog["comments"]);
            else $blog["commentsCount"] = 0;

            // process categories
            $blog["categories"] = $this->processCategories($blog["id"]);

            return $blog;
        } else return false;
    }

    /**
     * edits data on blog in database 
     * 
     * @param string $username the username who is making the blog
     * 
     * @param array $post_data the data as title and text 
     * 
     * @param array $image_data the image data form $_FILES
     */
    public function makeBlog(string $username, array $post_data, array $image_data)
    {
        $this->db->makeBlog($username, $post_data, $image_data);
    }

    /**
     * edits data on blog in database 
     * 
     * @param string $blogId the ID of the blog to edit
     * 
     * @param array $post_data the data as title and text 
     * 
     * @param array $image_data the image data form $_FILES
     */
    public function editBlog(string $blogId, array $post_data, array $image_data)
    {
        $this->db->editBlog($blogId, $post_data, $image_data);
    }

    /**
     * deletes the blog form database width that ID
     * 
     * @param $blogId ID of blog to delete
     */
    public function deleteBlog(string $blogId)
    {
        $this->db->deleteBlogByID($blogId);
    }

    // comment_control
    /**
     * removes a comment form database
     * 
     * @param string $commentId the ID of the comment that need to be removed  
     */
    public function deleteComment(string $commentId)
    {
        $this->db->deleteCommentById($commentId);
    }
}
