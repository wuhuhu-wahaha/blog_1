<?php


namespace Blog\Classes;

use Blog\Classes\helperClass;
use Blog\Interfaces\database;
use mysql_xdevapi\Exception;

class posts
{

    private const IMAGES_DIR = '"../static/images/';
    /**
     * @var database|null
     */
    private $database = null;

    /**
     * blog constructor.
     *
     * @param Database $db
     */
    public function __construct(database $db) {
        $this->database = $db;
    }

    /**
     * Returns blog list as array.
     *
     * @return mysqli_result
     */
    public function getBlogList():mysqli_result{

        return $this->database->query('SELECT * FROM users ORDER BY id DESC');

    }

    /**
     * @param string $title
     * @param string $body
     * @param int $topicId
     * @param bool $published
     * @param array $image
     * @return bool
     * @throws \Exception
     */
    function createPost(string $title, string $body, int $topicId, bool $published, array $image) : bool
    {
        try {

            $featured_image =$this->_moveImage($image);
            $slug = helperClass::makeSlug($title);
            $this->_checkPostExists($slug);
            $query = sprintf(
                "INSERT INTO posts (user_id, title, slug, image, body, published, created_at, updated_at) VALUES(1, '%s', '%s','%s','%s', %i,'%s','%s')",
                $title, $slug, $featured_image, $body, (int) $published, now(), now()
            );

            if($this->database->query($query)){

                $inserted_post_id = $this->database->insert_id();
                // create relationship between post and topic
                $sql = "INSERT INTO post_topic (post_id, topic_id) VALUES($inserted_post_id, $topicId)";
                $this->database->query($sql);

            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /* * * * * * * * * * * * * * * * * * * * *
    * - Takes post id as parameter
    * - Fetches the post from database
    * - sets post fields on form for editing
    * * * * * * * * * * * * * * * * * * * * * */
    function editPost(int $postId) : ?array {
        return  $this->database->fetch_assoc('SELECT * FROM posts WHERE id=' . $postId . ' LIMIT 1');

    }

    function updatePost(string $title, string $body, int $postId, int $topicId, array $image,bool $published): bool
    {
        try {
        $featuredImage =$this->_moveImage($image);
        $slug = helperClass::makeSlug($title);
        $this->_checkPostExists($slug);

        $query = sprintf(
            "UPDATE posts SET title='%s', slug'%s', views=0, image='%s', body='%s', published=%i, updated_at='%s' WHERE id=%i",
            $title, $slug, $featuredImage, $body, (int) $published, now(), $postId
        );

        if($this->database->query($query)){
           // $insertedPostId = $this->database->insert_id();
            // create relationship between post and topic
            $sql = "INSERT INTO post_topic (post_id, topic_id) VALUES($postId, $topicId)";
            $this->database->query($sql);
        }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * delete blog post
     * @param $post_id
     *
     * @return bool
     */
    function deletePost($post_id): bool
    {
        try {
       $this->database->query('DELETE FROM posts WHERE id=$post_id');
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // delete blog post

    /**
     * delete blog post
     *
     * @param int $postId
     * @return bool
     */
    function togglePublishPost(int $postId):bool
    {
      try {
       $this->database->query("UPDATE posts SET published=!published WHERE id=$postId");
            return true;
        } catch (Exception $e) {
    return false;
    }
    }


    /**
     * @param array $image
     * @return string
     * @throws \Exception
     */
    private function _moveImage(array $image): string
    {

        $target = self::IMAGES_DIR . basename($image['featured_image']['name']);

        if (!move_uploaded_file($image['featured_image']['tmp_name'], $target)) {
            throw new \Exception('Upload Failed');
        }

        return $image['featured_image']['name'];

    }



    /**
     * Check is post exists.
     *
     * @param string $slug
     * @throws \Exception
     */
    private function _checkPostExists(string $slug): void
    {
        $post_check_query = "SELECT * FROM posts WHERE slug='$slug' LIMIT 1";
        $result = $this->database->query($post_check_query);
        if (mysqli_num_rows($result) > 0) { // if post exists
            throw new \Exception('Post already exists!');
        }
    }


}
