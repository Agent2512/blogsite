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
    // Categories

    public function getAllCategories()
    {
        return $this->getData("SELECT * FROM `categories`");
    }

    public function getCategoryID(string $categoryName)
    {
        return $this->getData("SELECT id FROM `categories` WHERE name = '$categoryName'")[0]["id"];
    }

    public function addCategoryToBlog(string $blogId, string $categoryId)
    {
        $this->createData("INSERT INTO `blogs_has_categories` (`id`, `blogId`, `categoryId`) VALUES (NULL, '$blogId', '$categoryId')");
    }

    // blog_control
    public function getBlogData(string $title, string $username)
    {
        $userId = $this->getUserId($username);

        return $this->getData("SELECT * FROM `blogs` WHERE user_id = '$userId' && title = '$title'")[0];
    }

    public function makeBlog(string $username, array $post_data, array $image_data)
    {
        $userId = $this->getUserId($username);
        $title = $post_data["title"];
        $decoration = $post_data["decoration"];
        $text = $post_data["text"];
        $categories = $post_data["categories"] ?? [];
        $imageName = $image_data["image"]["name"];


        $x1 = $this->createData("
        INSERT INTO `blogs` (`id`, `title`, `decoration`, `text`, `Image`, `user_id`, `timestamp`)
        VALUES (NULL, '$title', '$decoration', '$text', '$imageName', '$userId', current_timestamp());
        ");


        if (count($categories) != 0 && $x1 == true) {
            $blog = $this->getBlogData($title, $username);
            $blogId = $blog["id"];

            foreach ($categories as $category) {
                $categoryId = $this->getCategoryId($category);

                $this->addCategoryToBlog($blogId, $categoryId);
            }
        }
    }
}
