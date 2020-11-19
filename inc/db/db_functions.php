<?php
class db_functions extends db_connection
{
    // user_control
    public function getAllUsers()
    {
        return $this->getData("
            SELECT * FROM `login`
        ");
    }

    public function createUser(string $username, string $password, string $email)
    {
        return $this->createData("
        INSERT INTO `login` (`id`, `username`, `password`, `email`) VALUES (NULL, '$username', '$password', '$email');
        ");
    }

    public function getUserId(string $username)
    {
        return $this->getData("SELECT id  FROM `login` WHERE username = '$username'")[0]['id'];
    }
    // Categories_control
    public function deleteAllCategoriesToBlog(string $blogId)
    {
        $this->deleteData("
        DELETE FROM `blogs_has_categories` WHERE blogId = '$blogId'
        ");
    }

    public function getAllCategories()
    {
        $x = $this->getData("SELECT * FROM `categories`");

        if ($x == false) {
            return $x;
        }
        else {
            return array_column($x, "name");
        }
    }

    public function getCategoryID(string $categoryName)
    {
        return $this->getData("SELECT id FROM `categories` WHERE name = '$categoryName'")[0]["id"];
    }

    public function addCategoryToBlog(string $blogId, string $categoryId)
    {
        $this->createData("INSERT INTO `blogs_has_categories` (`id`, `blogId`, `categoryId`) VALUES (NULL, '$blogId', '$categoryId')");
    }

    public function getAllCategoriesToBlog(string $blogId)
    {
        $x = $this->getData("
        SELECT categories.name
        FROM `blogs_has_categories`
        INNER JOIN categories on categories.id = blogs_has_categories.categoryId
        WHERE blogs_has_categories.blogId = $blogId
        ");

        if ($x == false) {
            return $x;
        }
        else {
            return array_column($x, "name");
        }
    }
    // file_control
    public function deleteUnusedFiles()
    {
        $base = array_column($this->getData("SELECT Image FROM `blogs`"),"Image");

        $local = scandir("./img/uploads/");
        unset($local[0]);
        unset($local[1]);
        $local = array_values($local);

        $result = array_values(array_diff($local, $base));

        for ($i=0; $i < count($result); $i++) { 
            unlink("./img/uploads/$result[$i]");
        }
    }
    
    private function getAllUploadImageNames(string $target = "./img/uploads/")
    {
        $dir = scandir($target);
        unset($dir[0]);
        unset($dir[1]);
        $dir = array_values($dir);

        for ($i = 0; $i < count($dir); $i++) {
            $dir[$i] = explode(".", $dir[$i])[0];
        }

        return $dir;
    }

    private function uploadImage($fileLocation, $fileName, $fileDestination = "./img/uploads/")
    {
        move_uploaded_file($fileLocation, $fileDestination . $fileName);
    }
    // comment_control
    public function createComment(string $username, string $blog_id, string $comment)
    {
        $user_id = $this->getUserId($username);

        $this->createData("INSERT INTO `comments` (`id`, `text`, `blog_id`, `user_id`, `timestamp`) VALUES (NULL, '$comment', '$blog_id', '$user_id', current_timestamp());");
    }

    public function getAllCommentsToBlog(string $blog_id)
    {
        $x =  $this->getData("
        SELECT comments.id, comments.timestamp, comments.text, login.username
        FROM `comments`
        INNER JOIN login ON login.id = comments.user_id
        WHERE comments.blog_id = '$blog_id'
        ");

        if ($x == false) return $x;
        else return $x[0];
    }
    
    public function getCommentById(string $comment_id)
    {
        return $this->getData("SELECT * FROM `comments` WHERE id = '1'");
    }
    // blog_control
    public function deleteBlogByID(string $id)
    {
        $this->deleteData("DELETE FROM `blogs` WHERE id = '$id'");
    }

    public function getBlogOneData(string $title, string $username)
    {
        $userId = $this->getUserId($username);

        return $this->getData("SELECT * FROM `blogs` WHERE user_id = '$userId' && title = '$title'")[0];
    }

    public function getAllBlogs()
    {
        return $this->getData("
        SELECT blogs.id, blogs.title, blogs.decoration, blogs.text, blogs.Image, blogs.timestamp, login.username
        FROM `blogs`
        INNER JOIN login on login.id = blogs.user_id
        ");
    }
    public function getAllBlogImageNames()
    {
        $data = $this->getData("SELECT Image FROM `blogs`");
        $data = array_column($data, "Image");

        for ($i = 0; $i < count($data); $i++) {
            $data[$i] = explode(".", $data[$i])[0];
        }

        return  $data;
    }

    public function getBlogById(string $blogId)
    {
        $x = $this->getData("
        SELECT blogs.id, blogs.title, blogs.decoration, blogs.text, blogs.Image, login.username, blogs.timestamp
        FROM `blogs`
        INNER JOIN login ON login.id = blogs.user_id
        WHERE blogs.id = '$blogId'
        ");

        if ($x == false) {
            return $x;
        }
        else {
            return $x[0];
        }
    }

    public function makeBlog(string $username, array $post_data, array $image_data)
    {
        $userId = $this->getUserId($username);
        $title = $post_data["title"];
        $decoration = $post_data["decoration"];
        $text = $post_data["text"];
        $categories = $post_data["categories"] ?? [];

        $new_file = $image_data["image"];
        $new_file_name = explode(".", $new_file["name"])[0];
        $new_file_extension = "." . explode(".", $new_file["name"])[1];

        $i = 0;
        while (in_array($new_file_name, $this->getAllUploadImageNames())) {
            if (in_array($new_file_name . $i, $this->getAllUploadImageNames()) == false) {
                $new_file_name = $new_file_name . $i;

                break;
            }
            $i++;
        }
        $image = $new_file_name . $new_file_extension;

        $x1 = $this->createData("
        INSERT INTO `blogs` (`id`, `title`, `decoration`, `text`, `Image`, `user_id`, `timestamp`)
        VALUES (NULL, '$title', '$decoration', '$text', '$image', '$userId', current_timestamp());
        ");


        if (count($categories) != 0 && $x1 == true) {
            $blog = $this->getBlogOneData($title, $username);
            $blogId = $blog["id"];

            foreach ($categories as $category) {
                $categoryId = $this->getCategoryId($category);

                $this->addCategoryToBlog($blogId, $categoryId);
            }
        }

        if ($x1 == true) {
            $this->uploadImage($new_file["tmp_name"], $image);

            $this->deleteUnusedFiles();
        }
    }

    public function editBlog(string $blogId, array $post_data, array $image_data)
    {
        $title = $post_data["title"];
        $decoration = $post_data["decoration"];
        $text = $post_data["text"];
        $categories = $post_data["categories"] ?? [];

        $new_file = $image_data["image"];
        $new_file_name = explode(".", $new_file["name"])[0];
        $new_file_extension = "." . explode(".", $new_file["name"])[1];

        $i = 0;
        while (in_array($new_file_name, $this->getAllUploadImageNames())) {
            if (in_array($new_file_name . $i, $this->getAllUploadImageNames()) == false) {
                $new_file_name = $new_file_name . $i;

                break;
            }
            $i++;
        }
        $image = $new_file_name . $new_file_extension;

        $x1 = $this->updateData("
        UPDATE `blogs` 
        SET title='$title', decoration='$decoration', text='$text',Image='$image' 
        WHERE id = '$blogId'
        ");

        $this->deleteAllCategoriesToBlog($blogId);

        if (count($categories) != 0 && $x1 == true) {
            foreach ($categories as $category) {
                $categoryId = $this->getCategoryId($category);

                $this->addCategoryToBlog($blogId, $categoryId);
            }
        }

        if ($x1 == true) {
            $this->uploadImage($new_file["tmp_name"], $image);

            $this->deleteUnusedFiles();
        }
    }
}
