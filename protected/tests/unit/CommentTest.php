<?php
/**
 * 
 **/
class CommentTest extends CDbTestCase
{
    public function testFindRecentComments()
    {
        $comments = Comment::model()->findRecentComments();
        $this->assertTrue(is_array($comments));
        $this->assertTrue(count($comments)>0);
    }
}
?>
