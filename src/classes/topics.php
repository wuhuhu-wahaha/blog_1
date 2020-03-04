<?php
namespace Blog\Classes;

use Blog\Classes\helperClass;
use Blog\Interfaces\database;
use mysql_xdevapi\Exception;

/**
 * Class topics
 * @package Blog\Classes
 */

class topics
{
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
     * get all topics from DB
     * @return array
     */
//
    public function getAllTopics() : array {
        try{
            return $this->database->fetch_all('SELECT * FROM topics');
        } catch ( Exception $e) {
           return  null;
        }
    }

    private function _checkTopicExists(string $slug): void
    {
        $post_check_query = "SELECT * FROM topics WHERE slug='$slug' LIMIT 1";
        $result = $this->database->query($post_check_query);
        if (mysqli_num_rows($result) > 0) { // if post exists
            throw new \Exception('Post already exists!');
        }
    }

    /**
     * create Topic
     * @param String $topicName
     *
     * @return bool
     */
    function createTopic(String $topicName) : bool {
        try{
            $topicSlug = helperClass::makeSlug($topicName);
            $this->_checkPostExists($topicSlug);
            $this->database->query("INSERT INTO topics (name, slug) VALUES('$topicName', '$topicSlug')");
            return true;
        } catch ( Exception $e) {
            return  false;
        }
    }

    /**
     * Fetches the topic from database
     * @param $topic_id
     * @return array
     */
    function editTopic($topic_id) : array {
        try{
            return $this->database->fetch_assoc("SELECT * FROM topics WHERE id=$topic_id LIMIT 1");
        } catch ( Exception $e) {
            return  null;
        }
    }

    /**
     * update Topic
     * @param string $topicName
     * @param int $topicId
     * @return bool
     */
    function updateTopic( string $topicName, int $topicId): bool {
        try{
            $topicSlug = helperClass::makeSlug($topicName);
            $this->_checkPostExists($topicSlug);
            $this->database->query("UPDATE topics SET name='$topicName', slug='$topicSlug' WHERE id=$topicId");
            return true;
        } catch ( Exception $e) {
            return false;
        }
    }
// delete topic
    function deleteTopic( int $topicId): bool {
        try{
            $this->database->query("DELETE FROM topics WHERE id=$topicId");
            return true;
        } catch ( Exception $e) {
            return false;
        }
    }
}
