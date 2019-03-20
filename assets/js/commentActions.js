function postComment(button, postedBy, videoId, replyTo, containerClass){
    var textArea = $(button).siblings("textarea");
    var commentText = textArea.val();
    textArea.val("");

    if(commentText){
        $.post("ajax/postComment.php",
            {commentText: commentText, postedBy: postedBy, videoId: videoId, responseTo: replyTo})
            .done(function(comment){
                $("." + containerClass).prepend(comment);
        });
    } else{
        alert("You can't post an empty comment.");
    }
}