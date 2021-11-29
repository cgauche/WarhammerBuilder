<div class="main_panel">
    <div class="header_panel"><span class="text"><slot name="header"></slot></span></div>
    <div class="body_panel">
        <div class="left_panel pretty_panel overflow_panel">
            <slot name="left"></slot>
        </div>
        <div class="right_panel pretty_panel overflow_panel">
            <slot name="right"></slot>
        </div>
        <div style="clear:both"></div>
    </div>
    <div class="footer_panel">
        <slot name="footer"></slot>
    </div>
</div>
<style>
    .main_panel {
        position: relative;
        margin: auto;
        min-height: 900px;
        width: 1100px;
    }

    .header_panel {
        background: rgb(61, 61, 61);
        display: flex;
        border: 1px solid #F39814;
        height: 30px;
        margin-bottom: 5px;
        width: 100%;
    }

    .body_panel {
        background: rgb(61, 61, 61);
        border-left: 1px solid #F39814;
        border-right: 1px solid #F39814;
        border-top: 1px solid #F39814;
        height: 100%;
        width: 100%;
    }

    .footer_panel {
        background: rgb(61, 61, 61);
        border-bottom: 1px solid #F39814;
        border-right: 1px solid #F39814;
        border-left: 1px solid #F39814;
        height: 50px;
        width: 100%;
    }

    .right_panel, .left_panel {
        margin: 10px 10px 0 10px;
        height: 788px;
    }

    .pretty_panel {
        background: rgb(86, 86, 86);
        border: 1px solid #F39814;
    }

    .overflow_panel {
        overflow: auto;
    }

    .left_panel {
        width: 500px;
        float: left;
    }

    .right_panel {
        width: 556px;
        float: left;
    }
    .header_panel .text {
        margin: auto;
        font-size: 1em;
        font-family: Verdana,Arial,sans-serif;
    }
</style>