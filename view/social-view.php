<?php

$icons = '<div class="gallery-social-icons">👍 💬</div>';
$comments = '<div class="gallery-social-comments"></div>';
$comment_input = '<div class="gallery-social-comment">
                <textarea placeholder="Write a comment..." name="comment" class="comment-text-box"></textarea>
                <button class="comment-post-btn" disabled>Post</button>
            </div>';
$comment_length = '<div class="comment-length"></div>';
$comment_length_error = '<div class="comment-length-error">Comment is too long, must be less than 150 characters</div>';
$comment_format_error = '<div class="comment-format-error">Comment format is incorrect</div>';
$social = '<form action="" method="POST" class="gallery-social-block">'.$icons.$comments.$comment_input.$comment_format_error.$comment_length.$comment_length_error.' </form>';

?>