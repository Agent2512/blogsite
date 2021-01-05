<?php
class db_functions extends db_connection
{
    // user_control

    /**
     * deletes a user in the database
     * 
     * @param string $user_id the ID of the user
     */
    public function userDelete(string $user_id)
    {
        $this->deleteData("DELETE FROM `login` WHERE `id` = $user_id");
    }

    /**
     * approves a user in the database
     * 
     * @param string $user_id the ID of the user
     */
    public function userApprove(string $user_id)
    {
        $this->updateData("UPDATE `login` SET `approved`= 1 WHERE `id` = $user_id");
    }

    /**
     * gets all users from database id, username, email and password
     * 
     * @return false|array returns false if an error occurred or the return form database is empty,
     * returns array if database return is one or more items
     */
    public function getAllUsers()
    {
        return $this->getData("
            SELECT * FROM `login`
        ");
    }

    /**
     * creates a new user in database
     * 
     * @param string $username the name of user
     * 
     * @param string $password the password of user
     * 
     * @param string $email the email of user
     * 
     * @return bool returns true if successful returns false if user can not created
     */
    public function createUser(string $username, string $password, string $email)
    {
        return $this->createData("
        INSERT INTO `login` (`id`, `username`, `password`, `email`) VALUES (NULL, '$username', '$password', '$email');
        ");
    }

    /**
     * gets userID bu string:username
     * 
     * @param string $username for the user you want ID on
     * 
     * @return false|string returns false if an error occurred or the return form database is empty,
     * returns string if database return successful
     */
    public function getUserId(string $username)
    {
        $x = $this->getData("SELECT id  FROM `login` WHERE username = '$username'");

        if ($x == false) return false;
        else return $x[0]['id'];
    }
    // Categories_control

    /**
     * removes all categories on one blog
     * 
     * @param string $blogId the ID of the blog to removes all categories
     * 
     * @return bool returns false if an error occurred returns true if successful 
     */
    public function deleteAllCategoriesToBlog(string $blogId)
    {
        $this->deleteData("
        DELETE FROM `blogs_has_categories` WHERE blogId = '$blogId'
        ");
    }

    /**
     * gets all categories on form database
     * 
     * @return false|array returns false if an error occurred or the return form database is empty, 
     * returns array if database return is one or more items
     */
    public function getAllCategories()
    {
        $x = $this->getData("SELECT * FROM `categories`");

        if ($x == false) return $x;
        else return array_column($x, "name");
    }

    /**
     * gets the ID of category
     * 
     * @param string $categoryName the name of category to ID
     * 
     * @return false|string returns false if an error occurred or the return form database is empty,
     * returns string if database return successful
     */
    public function getCategoryID(string $categoryName)
    {
        $x = $this->getData("SELECT id FROM `categories` WHERE name = '$categoryName'");

        if ($x == false) return false;
        else return $x[0]['id'];
    }

    /**
     * adds one category to a blog in database
     * 
     * @param string $blogId the id of blog
     * 
     * @param string $categoryId the ID of the category to addCategoryToBlog
     * 
     * @return bool returns true if successful to add category to blog
     */
    public function addCategoryToBlog(string $blogId, string $categoryId)
    {
        return $this->createData("INSERT INTO `blogs_has_categories` (`id`, `blogId`, `categoryId`) VALUES (NULL, '$blogId', '$categoryId')");
    }

    /**
     * gets all categories to one blog in database
     * 
     * @param string $blogId the ID of the blog to get categories
     * 
     * @return false|array returns false if an error occurred or the return form database is empty,
     * returns array if database return is one or more items
     */
    public function getAllCategoriesToBlog(string $blogId)
    {
        $x = $this->getData("
        SELECT categories.name
        FROM `blogs_has_categories`
        INNER JOIN categories on categories.id = blogs_has_categories.categoryId
        WHERE blogs_has_categories.blogId = $blogId
        ");

        if ($x == false) return false;
        else return array_column($x, "name");
    }
    // file_control
    // nothing to do with database

    /**
     * finds a available image name so there is not two file name the same
     * 
     * @param array $image_data the $_FILES data off a POST event
     * 
     * @return string the new name of the image to use on server
     */
    public function getAvailableImageName(array $image_data)
    {
        // splits data in to two smaller values
        $new_file_name = explode(".", $image_data["image"]["name"])[0];
        $new_file_extension = "." . explode(".", $image_data["image"]["name"])[1];

        // keeps adding a number to image name 
        $i = 0;
        while (in_array($new_file_name, $this->getAllUploadImageNames())) {
            if (in_array($new_file_name . $i, $this->getAllUploadImageNames()) == false) {
                return $new_file_name . $i . $new_file_extension;
            }
            $i++;
        }
        return $new_file_name . $new_file_extension;
    }

    /**
     * remove all unused files from ./img/uploads
     * compared to fileNames on database
     */
    public function deleteUnusedFiles()
    {
        // gets all fileName from database
        $base = array_column($this->getData("SELECT Image FROM `blogs`"), "Image");

        // scans dir
        $dir = scandir("./img/uploads/");
        unset($dir[0]); // removed "."
        unset($dir[1]); // removed ".."
        $dir = array_values($dir); // re-index array

        // finds the difference between database and dir 
        $result = array_values(array_diff($dir, $base));

        // deletes all files in dir not used in database
        for ($i = 0; $i < count($result); $i++) {
            unlink("./img/uploads/$result[$i]");
        }
    }

    /**
     * get a array with all dir fileName 
     * no file execution
     * 
     * @param string $target default: "./img/uploads/" can be changed
     * 
     * @return array off file in $target dir with no file execution
     */
    private function getAllUploadImageNames(string $target = "./img/uploads/")
    {
        // scans dir
        $dir = scandir("./img/uploads/");
        unset($dir[0]); // removed "."
        unset($dir[1]); // removed ".."
        $dir = array_values($dir); // re-index array

        // removes file executions
        for ($i = 0; $i < count($dir); $i++) {
            $dir[$i] = explode(".", $dir[$i])[0];
        }

        return $dir;
    }

    /**
     * uploads file to set dir
     * 
     * @param string $fileLocation the location of the you want to upload
     * 
     * @param string $fileName what should the name be on the file
     * 
     * @param string $fileDestination what dir should the file end op
     * 
     * @return bool returns true if successful
     */
    private function uploadImage($fileLocation, $fileName, $fileDestination = "./img/uploads/")
    {
        return move_uploaded_file($fileLocation, $fileDestination . $fileName);
    }
    // comment_control
    /**
     * makes a comment to a blog in database
     * 
     * @param string $username the username of comment
     * 
     * @param string $blogId the ID of the blog to add comment
     * 
     * @param string $comment is the text of the comment
     * 
     * @return bool returns true if successful
     */
    public function createComment(string $username, string $blogId, string $comment)
    {
        $user_id = $this->getUserId($username);
        if ($user_id == false) return false;

        return $this->createData("INSERT INTO `comments` (`id`, `text`, `blog_id`, `user_id`, `timestamp`) VALUES (NULL, '$comment', '$blogId', '$user_id', current_timestamp());");
    }

    /**
     * gets all comments for one blog
     * 
     * @param string $blogId the ID of the blog to get all comments
     * 
     * @return false|array returns false if an error occurred or the return form database is empty,
     * returns array if database return is one or more items
     */
    public function getAllCommentsToBlog(string $blogId)
    {
        return $this->getData("
        SELECT comments.id, comments.timestamp, comments.text, login.username
        FROM `comments`
        INNER JOIN login ON login.id = comments.user_id
        WHERE comments.blog_id = '$blogId'
        ");
    }

    /**
     * gets comments by ID 
     * 
     * @param string $commentId the ID of the comment to return
     * 
     * @return false|array returns false if an error occurred or the return form database is empty,
     * returns array if database return is one
     */
    public function getCommentById(string $commentId)
    {
        $x = $this->getData("
        SELECT comments.id, comments.text, comments.blog_id, comments.user_id, comments.timestamp, login.username
        FROM `comments`
        INNER JOIN login on login.id = comments.user_id
        WHERE comments.id = '$commentId'
        ");

        if ($x == false) return false;
        else return $x[0];
    }

    /**
     * deletes one comment by ID
     * 
     * @param string $commentId the ID of the comment to delete
     * 
     * @return bool returns true if successful
     */
    public function deleteCommentById(string $commentId)
    {
        return $this->deleteData("DELETE FROM `comments` WHERE id = '$commentId'");
    }
    // blog_control

    /**
     * approves a blog to be published
     * 
     * @param string $id ID of blog
     * 
     * @return bool returns true if successful
     */
    public function approveBlogByID(string $id)
    {
        return $this->updateData("UPDATE `blogs` SET `approved`= 1 WHERE `id` = $id");
    }

    /**
     * deletes one blog by ID
     * 
     * @param string $id the ID of the blog to delete 
     * 
     * @return bool returns true if successful
     */
    public function deleteBlogByID(string $id)
    {
        $x = $this->deleteData("DELETE FROM `blogs` WHERE id = '$id'");

        $this->deleteUnusedFiles();

        return $x;
    }

    /**
     * get a ine blog in database with $title and $username and no ID
     * 
     * @param string $title the title of blog
     * 
     * @param string $username who created the blog
     * 
     * @return false|array returns false if an error occurred or the return form database is empty,
     * returns array if database return is one
     */
    public function getBlogOneData(string $title, string $username)
    {
        $userId = $this->getUserId($username);
        if ($userId == false) return false;

        $x = $this->getData("SELECT * FROM `blogs` WHERE user_id = '$userId' && title = '$title'");

        if ($x == false) return false;
        else return $x[0];
    }

    /**
     * gets all blog in database
     * 
     * @return false|array returns false if an error occurred or the return form database is empty,
     * returns array if database return is one or more items
     */
    public function getAllBlogs()
    {
        return $this->getData("
        SELECT blogs.id, blogs.title, blogs.decoration, blogs.text, blogs.Image, blogs.timestamp, blogs.approved, login.username
        FROM `blogs`
        INNER JOIN login on login.id = blogs.user_id
        ");
    }

    /**
     * get all blogs images names with no execution
     * 
     * @return false|array returns false if an error occurred or the return form database is empty,
     * returns array if database return is one or more items
     */
    public function getAllBlogImageNames()
    {
        $data = $this->getData("SELECT Image FROM `blogs`");
        if ($data == false) return false;

        $data = array_column($data, "Image");

        for ($i = 0; $i < count($data); $i++) {
            $data[$i] = explode(".", $data[$i])[0];
        }

        return $data;
    }

    /**
     * gets one blog by ID from database
     * 
     * @param string $blogId the ID of the blog
     * 
     * @return false|array returns false if an error occurred or the return form database is empty,
     * returns array if database return is one
     */
    public function getBlogById(string $blogId)
    {
        $x = $this->getData("
        SELECT blogs.id, blogs.title, blogs.decoration, blogs.text, blogs.Image, blogs.approved, login.username, blogs.timestamp
        FROM `blogs`
        INNER JOIN login ON login.id = blogs.user_id
        WHERE blogs.id = '$blogId'
        ");

        if ($x == false) return false;
        else return $x[0];
    }

    /**
     * makes a blog on the database with all data as categories and image
     * 
     * @param string $username the username of who is making a blog
     * 
     * @param array $post_data all text data the blog need
     * 
     * @param array $image_data all image data form $_FILES  
     * 
     * @return bool returns true if successful
     */
    public function makeBlog(string $username, array $post_data, array $image_data)
    {
        $userId = $this->getUserId($username);
        if ($userId == false) return false;

        $title = $post_data["title"];
        $decoration = $post_data["decoration"];
        $text = $post_data["text"];
        $categories = $post_data["categories"] ?? [];

        $image = $this->getAvailableImageName($image_data);

        $x = $this->createData("
        INSERT INTO `blogs` (`id`, `title`, `decoration`, `text`, `Image`, `user_id`, `timestamp`)
        VALUES (NULL, '$title', '$decoration', '$text', '$image', '$userId', current_timestamp());
        ");

        if ($x == true) {
            $uploadImage = $this->uploadImage($image_data["image"]["tmp_name"], $image);
            if ($uploadImage == false) return false;

            $this->deleteUnusedFiles();

            $blog = $this->getBlogOneData($title, $username);
            if ($blog == false) return false;

            if (count($categories) != 0) foreach ($categories as $category) {
                $categoryId = $this->getCategoryId($category);

                $this->addCategoryToBlog($blog["id"], $categoryId);
            }

            return true;
        } else return false;
    }

    /**
     * edits a blog on the database with all data as categories and image
     * 
     * @param string $blogId the ID of the blog there need to be edited
     * 
     * @param array $post_data all text data the blog need
     * 
     * @param array $image_data all image data form $_FILES  
     * 
     * @return bool returns true if successful
     */
    public function editBlog(string $blogId, array $post_data, array $image_data)
    {
        $title = $post_data["title"];
        $decoration = $post_data["decoration"];
        $text = $post_data["text"];
        $categories = $post_data["categories"] ?? [];

        $image = $this->getAvailableImageName($image_data);

        $x = $this->updateData("
        UPDATE `blogs` 
        SET title='$title', decoration='$decoration', text='$text',Image='$image' 
        WHERE id = '$blogId'
        ");

        $this->deleteAllCategoriesToBlog($blogId);

        if ($x == true) {
            $uploadImage = $this->uploadImage($image_data["image"]["tmp_name"], $image);
            if ($uploadImage == false) return false;

            $this->deleteUnusedFiles();

            if (count($categories) != 0) foreach ($categories as $category) {
                $categoryId = $this->getCategoryId($category);

                $this->addCategoryToBlog($blogId, $categoryId);
            }

            return true;
        } else return false;
    }
}
