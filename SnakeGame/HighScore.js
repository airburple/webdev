
  var notice_username = "Username" + " : ";
  var notice_score = username + "ScoreGoesHere";
  var msg = "hello test";
  var timer_id = null;
  var running_flag = false;
  var waiting_time = 100;

  for(i = 0; i < 40; i++)
    msg = " " + msg;

  function scrollScore() {
    document.scoreBoard.ScoreBoard.value = msg.substring(0, 39);
    msg = msg.substring(1, msg.length) + msg.substring(0, 1);
    timer_id = setTimeout("scrollScore()", waiting_time);
    running_flag = true;
  }

  function stopScore() {
    if(running_flag)
      clearTimeout(timer_id);
    running_flag = false;
  }

  function startScore() {
    stopScore();
    scrollScore();
  };