var _0x2593 = ['manageSidebarBg', 'manageSidebarPosition', 'manageRtlLayout', 'manageResponsiveSidebar', 'dark', 'attr', 'data-theme-version', 'prototype', 'layout', 'horizontal', 'overlay', 'data-sidebar-style', 'data-layout', 'vertical', 'data-nav-headerbg', 'data-headerbg', 'mini', 'compact', 'data-sibebarbg', 'data-sidebar-position', 'fixed', 'data-header-position', 'boxed', 'data-container', 'wide', 'wide-boxed', 'rtl', 'dir', 'innerWidth', 'body', 'html', 'version', 'light', 'navheaderBg', 'color_1', 'headerBg', 'sidebarStyle', 'full', 'sidebarBg', 'sidebarPosition', 'static', 'headerPosition', 'containerLayout', 'direction', 'ltr', 'manageVersion', 'manageLayout', 'manageNavHeaderBg', 'manageHeaderBg', 'manageSidebarStyle'];
(function (_0x687f78, _0x1e9fae) {
    var _0x3bced2 = function (_0x465f91) {
        while (--_0x465f91) {
            _0x687f78['push'](_0x687f78['shift']());
        }
    };
    _0x3bced2(++_0x1e9fae);
}(_0x2593, 0x1df));
var _0x2627 = function (_0x1596a1, _0x41d08e) {
    _0x1596a1 = _0x1596a1 - 0x0;
    var _0x2256ab = _0x2593[_0x1596a1];
    return _0x2256ab;
};
var body = $(_0x2627('0x0'));
var html = $(_0x2627('0x1'));

function quixSettings({
                          version,
                          layout,
                          navheaderBg,
                          headerBg,
                          sidebarStyle,
                          sidebarBg,
                          sidebarPosition,
                          headerPosition,
                          containerLayout,
                          direction
                      }) {
    this[_0x2627('0x2')] = version || _0x2627('0x3');
    this['layout'] = layout || 'vertical';
    this[_0x2627('0x4')] = navheaderBg || _0x2627('0x5');
    this[_0x2627('0x6')] = headerBg || _0x2627('0x5');
    this[_0x2627('0x7')] = sidebarStyle || _0x2627('0x8');
    this[_0x2627('0x9')] = sidebarBg || _0x2627('0x5');
    this[_0x2627('0xa')] = sidebarPosition || _0x2627('0xb');
    this[_0x2627('0xc')] = headerPosition || 'static';
    this[_0x2627('0xd')] = containerLayout || 'wide';
    this[_0x2627('0xe')] = direction || _0x2627('0xf');
    this[_0x2627('0x10')]();
    this[_0x2627('0x11')]();
    this[_0x2627('0x12')]();
    this[_0x2627('0x13')]();
    this[_0x2627('0x14')]();
    this[_0x2627('0x15')]();
    this[_0x2627('0x16')]();
    this['manageHeaderPosition']();
    this['manageContainerLayout']();
    this[_0x2627('0x17')]();
    this[_0x2627('0x18')]();
}

quixSettings['prototype'][_0x2627('0x10')] = function () {
    switch (this[_0x2627('0x2')]) {
        case _0x2627('0x3'):
            body['attr']('data-theme-version', _0x2627('0x3'));
            break;
        case _0x2627('0x19'):
            body[_0x2627('0x1a')]('data-theme-version', _0x2627('0x19'));
            break;
        default:
            body[_0x2627('0x1a')](_0x2627('0x1b'), _0x2627('0x3'));
    }
};
quixSettings[_0x2627('0x1c')][_0x2627('0x11')] = function () {
    switch (this[_0x2627('0x1d')]) {
        case _0x2627('0x1e'):
            this[_0x2627('0x7')] === _0x2627('0x1f') ? body['attr'](_0x2627('0x20'), 'full') : body[_0x2627('0x1a')]('data-sidebar-style', '' + this[_0x2627('0x7')]);
            body[_0x2627('0x1a')](_0x2627('0x21'), _0x2627('0x1e'));
            break;
        case _0x2627('0x22'):
            body[_0x2627('0x1a')]('data-layout', _0x2627('0x22'));
            break;
        default:
            body[_0x2627('0x1a')]('data-layout', _0x2627('0x22'));
    }
};
quixSettings['prototype'][_0x2627('0x12')] = function () {
    switch (this[_0x2627('0x4')]) {
        case this[_0x2627('0x4')]:
            body[_0x2627('0x1a')](_0x2627('0x23'), this[_0x2627('0x4')]);
            break;
        default:
            body[_0x2627('0x1a')](_0x2627('0x23'), 'color_1');
    }
};
quixSettings[_0x2627('0x1c')][_0x2627('0x13')] = function () {
    switch (this['headerBg']) {
        case this[_0x2627('0x6')]:
            body[_0x2627('0x1a')](_0x2627('0x24'), this[_0x2627('0x6')]);
            break;
        default:
            body['attr']('data-headerbg', 'color_1');
    }
};
quixSettings['prototype']['manageSidebarStyle'] = function () {
    switch (this[_0x2627('0x7')]) {
        case'full':
            body[_0x2627('0x1a')]('data-sidebar-style', _0x2627('0x8'));
            break;
        case _0x2627('0x25'):
            body[_0x2627('0x1a')](_0x2627('0x20'), _0x2627('0x25'));
            break;
        case _0x2627('0x26'):
            body['attr']('data-sidebar-style', 'compact');
            break;
        case _0x2627('0x1f'):
            this[_0x2627('0x1d')] === _0x2627('0x1e') ? body[_0x2627('0x1a')](_0x2627('0x20'), 'full') : body[_0x2627('0x1a')](_0x2627('0x20'), _0x2627('0x1f'));
            break;
        default:
            body[_0x2627('0x1a')]('data-sidebar-style', _0x2627('0x8'));
    }
};
quixSettings[_0x2627('0x1c')][_0x2627('0x15')] = function () {
    switch (this['sidebarBg']) {
        case this['sidebarBg']:
            body[_0x2627('0x1a')](_0x2627('0x27'), this['sidebarBg']);
            break;
        default:
            body['attr']('data-sibebarbg', _0x2627('0x5'));
    }
};
quixSettings[_0x2627('0x1c')]['manageSidebarPosition'] = function () {
    switch (this[_0x2627('0xa')]) {
        case'fixed':
            this[_0x2627('0x7')] === _0x2627('0x1f') && this[_0x2627('0x1d')] === _0x2627('0x22') ? body[_0x2627('0x1a')](_0x2627('0x28'), _0x2627('0xb')) : body[_0x2627('0x1a')]('data-sidebar-position', _0x2627('0x29'));
            break;
        case _0x2627('0xb'):
            body[_0x2627('0x1a')](_0x2627('0x28'), _0x2627('0xb'));
            break;
        default:
            body[_0x2627('0x1a')](_0x2627('0x28'), 'static');
    }
};
quixSettings[_0x2627('0x1c')]['manageHeaderPosition'] = function () {
    switch (this[_0x2627('0xc')]) {
        case _0x2627('0x29'):
            body[_0x2627('0x1a')](_0x2627('0x2a'), _0x2627('0x29'));
            break;
        case _0x2627('0xb'):
            body['attr'](_0x2627('0x2a'), 'static');
            break;
        default:
            body[_0x2627('0x1a')]('data-header-position', 'static');
    }
};
quixSettings[_0x2627('0x1c')]['manageContainerLayout'] = function () {
    switch (this['containerLayout']) {
        case _0x2627('0x2b'):
            if (this['layout'] === _0x2627('0x22') && this[_0x2627('0x7')] === 'full') {
                body[_0x2627('0x1a')]('data-sidebar-style', 'overlay');
            }
            body[_0x2627('0x1a')](_0x2627('0x2c'), 'boxed');
            break;
        case _0x2627('0x2d'):
            body[_0x2627('0x1a')](_0x2627('0x2c'), _0x2627('0x2d'));
            break;
        case _0x2627('0x2e'):
            body[_0x2627('0x1a')](_0x2627('0x2c'), _0x2627('0x2e'));
            break;
        default:
            body[_0x2627('0x1a')](_0x2627('0x2c'), 'wide');
    }
};
quixSettings[_0x2627('0x1c')][_0x2627('0x17')] = function () {
    switch (this[_0x2627('0xe')]) {
        case'rtl':
            html[_0x2627('0x1a')]('dir', _0x2627('0x2f'));
            html['addClass'](_0x2627('0x2f'));
            body[_0x2627('0x1a')]('direction', 'rtl');
            break;
        case _0x2627('0xf'):
            html[_0x2627('0x1a')](_0x2627('0x30'), _0x2627('0xf'));
            html['removeClass'](_0x2627('0x2f'));
            body[_0x2627('0x1a')](_0x2627('0xe'), 'ltr');
            break;
        default:
            html[_0x2627('0x1a')](_0x2627('0x30'), _0x2627('0xf'));
            body[_0x2627('0x1a')](_0x2627('0xe'), 'ltr');
    }
};
quixSettings[_0x2627('0x1c')][_0x2627('0x18')] = function () {
    const _0x598821 = $(window)[_0x2627('0x31')]();
    if (_0x598821 < 0x4b0) {
        body['attr'](_0x2627('0x21'), _0x2627('0x22'));
        body['attr'](_0x2627('0x2c'), _0x2627('0x2d'));
    }
    if (_0x598821 > 0x2ff && _0x598821 < 0x4b0) {
        body[_0x2627('0x1a')](_0x2627('0x20'), _0x2627('0x25'));
    }
    if (_0x598821 < 0x300) {
        body[_0x2627('0x1a')](_0x2627('0x20'), _0x2627('0x1f'));
    }
};
