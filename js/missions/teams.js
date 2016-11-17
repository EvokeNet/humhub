// ajax request to follow the user
function setFollow(url, id) {
 jQuery.ajax({
  url: url,
  type: "POST",
  success: function(e) {
   console.log(e);
   $("#button_follow_" + id).addClass('hide');
   $("#button_unfollow_" + id).removeClass('hide');
  }
 });
}

// ajax request to unfollow the user
function setUnfollow(url, id) {
 jQuery.ajax({
  url: url,
  type: "POST",
  'success': function() {
   $("#button_follow_" + id).removeClass('hide');
   $("#button_unfollow_" + id).addClass('hide');
  }
 });
}