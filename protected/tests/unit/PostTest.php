<?php
require_once '/opt/webapp/art/protected/lib/globals.php';

class PostTest extends CDbTestCase
{
    public function testFindRecentPosts()
    {
        $posts = Post::model()->findRecentPosts(40,'過年');
        $this->assertTrue(is_array($posts));
    }
}
?>
