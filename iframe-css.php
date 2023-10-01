<style>

/* IFRAME で表示する */
html,body {
    height: 100%;
}

body {
    margin: 0;
}
#bbs {
    width: 100%;
    height: <?= $view_head_height ?>px;
    background-color: #fff;
}
#extend {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: calc( 100% - 4px );
    height: calc( 100% - <?= $view_head_height ?>px - 2px );
    border: solid 2px #c0c0c0;
}
</style>
