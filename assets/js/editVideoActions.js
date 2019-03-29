function setNewThumbnail(itemElement, thumbnailId, videoId){
    $.post("ajax/updateThumbnail.php", {videoId: videoId, thumbnailId: thumbnailId})
        .done(function(){
            var item = $(itemElement);
            var itemClass = item.attr("class");

            $("." + itemClass).removeClass("selected");

            item.addClass("selected");
            alert("Thumbnail updated.");
        });
}