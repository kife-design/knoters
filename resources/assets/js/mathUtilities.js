percentPosition = function (position) {
    return {
        'x': position.x / $('#note-workspace').width() * 100,
        'y': position.y / $('#note-workspace').height() * 100
    };
}