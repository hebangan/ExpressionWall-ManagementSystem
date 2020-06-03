var boo = 0;
var canUse = document.getElementsByTagName("body")[0].style;
if (typeof canUse.animation != "undefined" || typeof canUse.WebkitAnimation != "undefined") {
    boo = 1;
} else {
    boo = 0;
}

function actionIn(obj, actionName, time, speed) {
    $(obj).show();
    if (boo == 1) $(obj).css({ "animation": actionName + " " + time + "s" + " " + speed, "animation-fill-mode": "forwards" });
}

function actionOut(obj, actionName, time, speed) {
    if (boo == 1) {
        $(obj).css({ "animation": actionName + " " + time + "s" + " " + speed });
        var setInt_obj = setInterval(function () {
            $(obj).hide();
            clearInterval(setInt_obj);
        }, time * 1000);
    } else $(obj).hide();
}
function begin() {
    actionIn("#box_action_translateY", 'action_translateY', 1, "");
    actionOut("#box_action_translateY", 'action_translateYOut', 2, "");
}