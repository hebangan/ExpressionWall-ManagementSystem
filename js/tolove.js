$(function () {
  $('input').keyup(function () {
    var s = $('input').val();
    $('.feeders').text(s);
  });

  $('textarea').keyup(function () {
    var tex = $('textarea').val();
    $('.title').text(tex);
  });
});
