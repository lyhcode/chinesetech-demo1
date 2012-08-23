<script>
// using jQuery
$('video,audio').mediaelementplayer(/* Options */
    defaultVideoWidth: 480,
    defaultVideoHeight: 270,
    videoWidth: -1,
    videoHeight: -1,
    audioWidth: 400,
    audioHeight: 30,
    startVolume: 0.8,
    loop: false,
    enableAutosize: true,
    features: ['playpause','progress','current','duration','tracks','volume','fullscreen'],
    alwaysShowControls: false,
    iPadUseNativeControls: false,
    iPhoneUseNativeControls: false, 
    AndroidUseNativeControls: false,
    alwaysShowHours: false,
    showTimecodeFrameCount: false,
    framesPerSecond: 25,
    enableKeyboard: true,
    pauseOtherPlayers: true,
    keyActions: []
);
</script>
</body>
</html>
