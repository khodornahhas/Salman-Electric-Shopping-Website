<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

<style id="apexcharts-css">
    body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background-color: #e6e8ed;
    color: #666666;
    font-family: "Montserrat", sans-serif;
    }

    .material-icons-outlined {
    vertical-align: middle;
    line-height: 1px;
    }

    .text-primary {
    color: #666666;
    }

    .text-blue {
    color: #246dec;
    }

    .text-red {
    color: #cc3c43;
    }

    .text-green {
    color: #367952;
    }

    .text-orange {
    color: #f5b74f;
    }

    .font-weight-bold {
    font-weight: 600;
    }

    .grid-container {
    display: grid;
    grid-template-columns: 260px 1fr 1fr 1fr;
    grid-template-rows: 0.2fr 3fr;
    grid-template-areas:
        "sidebar header header header"
        "sidebar main main main";
    height: 100vh;
    }


    /* ---------- HEADER ---------- */

    .header {
    grid-area: header;
    height: 70px;
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 30px 0 30px;
    box-shadow: 0 6px 7px -4px rgba(0, 0, 0, 0.2);
    }

    .menu-icon {
    display: none;
    }


    /* ---------- SIDEBAR ---------- */

    #sidebar {
    grid-area: sidebar;
    height: 100%;
    background-color: #21232d;
    color: #9799ab;
    overflow-y: auto;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    }

    .sidebar-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 20px 20px 20px;
    margin-bottom: 30px;
    }

    .sidebar-title > span {
    display: none;
    }

    .sidebar-brand {
    margin-top: 15px;
    font-size: 20px;
    font-weight: 700;
    }

    .sidebar-list {
    padding: 0;
    margin-top: 15px;
    list-style-type: none;
    }

    .sidebar-list-item {
    padding: 20px 20px 20px 20px;
    }

    .sidebar-list-item:hover {
    background-color: rgba(255, 255, 255, 0.2);
    cursor: pointer;
    }

    .sidebar-list-item > a {
    text-decoration: none;
    color: #9799ab;
    }

    .sidebar-responsive {
    display: inline !important;
    position: absolute;
    /*
        the z-index of the ApexCharts is 11
        we want the z-index of the sidebar higher so that
        the charts are not showing over the sidebar 
        on small screens
    */
    z-index: 12 !important;
    }


    /* ---------- MAIN ---------- */

    .main-container {
    grid-area: main;
    overflow-y: auto;
    padding: 20px 20px;
    }

    .main-title {
    display: flex;
    justify-content: space-between;
    }

    .main-title > p {
    font-size: 20px;
    }

    .main-cards {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    gap: 20px;
    margin: 20px 0;
    }

    .card {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    padding: 25px;
    background-color: #ffffff;
    box-sizing: border-box;
    border: 1px solid #d2d2d3;
    border-radius: 5px;
    box-shadow: 0 6px 7px -4px rgba(0, 0, 0, 0.2);
    }

    .card:first-child {
    border-left: 7px solid #246dec;
    }

    .card:nth-child(2) {
    border-left: 7px solid #f5b74f;
    }

    .card:nth-child(3) {
    border-left: 7px solid #367952;
    }

    .card:nth-child(4) {
    border-left: 7px solid #cc3c43;
    }

    .card > span {
    font-size: 20px;
    font-weight: 600;
    }

    .card-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    }

    .card-inner > p {
    font-size: 18px;
    }

    .card-inner > span {
    font-size: 35px;
    }

    .charts {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    }

    .charts-card {
    background-color: #ffffff;
    margin-bottom: 20px;
    padding: 25px;
    box-sizing: border-box;
    -webkit-column-break-inside: avoid;
    border: 1px solid #d2d2d3;
    border-radius: 5px;
    box-shadow: 0 6px 7px -4px rgba(0, 0, 0, 0.2);
    }

    .chart-title {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    font-weight: 600;
    }


    /* ---------- SCROLLBARS ---------- */

    ::-webkit-scrollbar {
    width: 5px;
    height: 6px;
    }

    ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px #a5aaad;
    border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
    background-color: #4f35a1;
    border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
    background-color: #a5aaad;
    }


    /* ---------- MEDIA QUERIES ---------- */


    /* Medium <= 992px */
    @media screen and (max-width: 992px) {
    .grid-container {
        grid-template-columns: 1fr;
        grid-template-rows: 0.2fr 3fr;
        grid-template-areas:
        "header"
        "main";
    }

    #sidebar {
        display: none;
    }

    .menu-icon {
        display: inline;
    }

    .sidebar-title > span {
        display: inline;
    }
    }

    /* Small <= 768px */
    @media screen and (max-width: 768px) {
    .main-cards {
        grid-template-columns: 1fr;
        gap: 10px;
        margin-bottom: 0;
    }

    .charts {
        grid-template-columns: 1fr;
        margin-top: 30px;
    }
    }

    /* Extra Small <= 576px */
    @media screen and (max-width: 576px) {
    .header-left {
        display: none;
    }
    }
    .apexcharts-canvas {
    position: relative;
    user-select: none;
    /* cannot give overflow: hidden as it will crop tooltips which overflow outside chart area */
    }


    /* scrollbar is not visible by default for legend, hence forcing the visibility */
    .apexcharts-canvas ::-webkit-scrollbar {
    -webkit-appearance: none;
    width: 6px;
    }

    .apexcharts-canvas ::-webkit-scrollbar-thumb {
    border-radius: 4px;
    background-color: rgba(0, 0, 0, .5);
    box-shadow: 0 0 1px rgba(255, 255, 255, .5);
    -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5);
    }


    .apexcharts-inner {
    position: relative;
    }

    .apexcharts-text tspan {
    font-family: inherit;
    }

    .legend-mouseover-inactive {
    transition: 0.15s ease all;
    opacity: 0.20;
    }

    .apexcharts-series-collapsed {
    opacity: 0;
    }

    .apexcharts-tooltip {
    border-radius: 5px;
    box-shadow: 2px 2px 6px -4px #999;
    cursor: default;
    font-size: 14px;
    left: 62px;
    opacity: 0;
    pointer-events: none;
    position: absolute;
    top: 20px;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    white-space: nowrap;
    z-index: 12;
    transition: 0.15s ease all;
    }

    .apexcharts-tooltip.apexcharts-active {
    opacity: 1;
    transition: 0.15s ease all;
    }

    .apexcharts-tooltip.apexcharts-theme-light {
    border: 1px solid #e3e3e3;
    background: rgba(255, 255, 255, 0.96);
    }

    .apexcharts-tooltip.apexcharts-theme-dark {
    color: #fff;
    background: rgba(30, 30, 30, 0.8);
    }

    .apexcharts-tooltip * {
    font-family: inherit;
    }


    .apexcharts-tooltip-title {
    padding: 6px;
    font-size: 15px;
    margin-bottom: 4px;
    }

    .apexcharts-tooltip.apexcharts-theme-light .apexcharts-tooltip-title {
    background: #ECEFF1;
    border-bottom: 1px solid #ddd;
    }

    .apexcharts-tooltip.apexcharts-theme-dark .apexcharts-tooltip-title {
    background: rgba(0, 0, 0, 0.7);
    border-bottom: 1px solid #333;
    }

    .apexcharts-tooltip-text-y-value,
    .apexcharts-tooltip-text-goals-value,
    .apexcharts-tooltip-text-z-value {
    display: inline-block;
    font-weight: 600;
    margin-left: 5px;
    }

    .apexcharts-tooltip-title:empty,
    .apexcharts-tooltip-text-y-label:empty,
    .apexcharts-tooltip-text-y-value:empty,
    .apexcharts-tooltip-text-goals-label:empty,
    .apexcharts-tooltip-text-goals-value:empty,
    .apexcharts-tooltip-text-z-value:empty {
    display: none;
    }

    .apexcharts-tooltip-text-y-value,
    .apexcharts-tooltip-text-goals-value,
    .apexcharts-tooltip-text-z-value {
    font-weight: 600;
    }

    .apexcharts-tooltip-text-goals-label, 
    .apexcharts-tooltip-text-goals-value {
    padding: 6px 0 5px;
    }

    .apexcharts-tooltip-goals-group, 
    .apexcharts-tooltip-text-goals-label, 
    .apexcharts-tooltip-text-goals-value {
    display: flex;
    }
    .apexcharts-tooltip-text-goals-label:not(:empty),
    .apexcharts-tooltip-text-goals-value:not(:empty) {
    margin-top: -6px;
    }

    .apexcharts-tooltip-marker {
    width: 12px;
    height: 12px;
    position: relative;
    top: 0px;
    margin-right: 10px;
    border-radius: 50%;
    }

    .apexcharts-tooltip-series-group {
    padding: 0 10px;
    display: none;
    text-align: left;
    justify-content: left;
    align-items: center;
    }

    .apexcharts-tooltip-series-group.apexcharts-active .apexcharts-tooltip-marker {
    opacity: 1;
    }

    .apexcharts-tooltip-series-group.apexcharts-active,
    .apexcharts-tooltip-series-group:last-child {
    padding-bottom: 4px;
    }

    .apexcharts-tooltip-series-group-hidden {
    opacity: 0;
    height: 0;
    line-height: 0;
    padding: 0 !important;
    }

    .apexcharts-tooltip-y-group {
    padding: 6px 0 5px;
    }

    .apexcharts-tooltip-box, .apexcharts-custom-tooltip {
    padding: 4px 8px;
    }

    .apexcharts-tooltip-boxPlot {
    display: flex;
    flex-direction: column-reverse;
    }

    .apexcharts-tooltip-box>div {
    margin: 4px 0;
    }

    .apexcharts-tooltip-box span.value {
    font-weight: bold;
    }

    .apexcharts-tooltip-rangebar {
    padding: 5px 8px;
    }

    .apexcharts-tooltip-rangebar .category {
    font-weight: 600;
    color: #777;
    }

    .apexcharts-tooltip-rangebar .series-name {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
    }

    .apexcharts-xaxistooltip {
    opacity: 0;
    padding: 9px 10px;
    pointer-events: none;
    color: #373d3f;
    font-size: 13px;
    text-align: center;
    border-radius: 2px;
    position: absolute;
    z-index: 10;
    background: #ECEFF1;
    border: 1px solid #90A4AE;
    transition: 0.15s ease all;
    }

    .apexcharts-xaxistooltip.apexcharts-theme-dark {
    background: rgba(0, 0, 0, 0.7);
    border: 1px solid rgba(0, 0, 0, 0.5);
    color: #fff;
    }

    .apexcharts-xaxistooltip:after,
    .apexcharts-xaxistooltip:before {
    left: 50%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    }

    .apexcharts-xaxistooltip:after {
    border-color: rgba(236, 239, 241, 0);
    border-width: 6px;
    margin-left: -6px;
    }

    .apexcharts-xaxistooltip:before {
    border-color: rgba(144, 164, 174, 0);
    border-width: 7px;
    margin-left: -7px;
    }

    .apexcharts-xaxistooltip-bottom:after,
    .apexcharts-xaxistooltip-bottom:before {
    bottom: 100%;
    }

    .apexcharts-xaxistooltip-top:after,
    .apexcharts-xaxistooltip-top:before {
    top: 100%;
    }

    .apexcharts-xaxistooltip-bottom:after {
    border-bottom-color: #ECEFF1;
    }

    .apexcharts-xaxistooltip-bottom:before {
    border-bottom-color: #90A4AE;
    }

    .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:after {
    border-bottom-color: rgba(0, 0, 0, 0.5);
    }

    .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:before {
    border-bottom-color: rgba(0, 0, 0, 0.5);
    }

    .apexcharts-xaxistooltip-top:after {
    border-top-color: #ECEFF1
    }

    .apexcharts-xaxistooltip-top:before {
    border-top-color: #90A4AE;
    }

    .apexcharts-xaxistooltip-top.apexcharts-theme-dark:after {
    border-top-color: rgba(0, 0, 0, 0.5);
    }

    .apexcharts-xaxistooltip-top.apexcharts-theme-dark:before {
    border-top-color: rgba(0, 0, 0, 0.5);
    }

    .apexcharts-xaxistooltip.apexcharts-active {
    opacity: 1;
    transition: 0.15s ease all;
    }

    .apexcharts-yaxistooltip {
    opacity: 0;
    padding: 4px 10px;
    pointer-events: none;
    color: #373d3f;
    font-size: 13px;
    text-align: center;
    border-radius: 2px;
    position: absolute;
    z-index: 10;
    background: #ECEFF1;
    border: 1px solid #90A4AE;
    }

    .apexcharts-yaxistooltip.apexcharts-theme-dark {
    background: rgba(0, 0, 0, 0.7);
    border: 1px solid rgba(0, 0, 0, 0.5);
    color: #fff;
    }

    .apexcharts-yaxistooltip:after,
    .apexcharts-yaxistooltip:before {
    top: 50%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    }

    .apexcharts-yaxistooltip:after {
    border-color: rgba(236, 239, 241, 0);
    border-width: 6px;
    margin-top: -6px;
    }

    .apexcharts-yaxistooltip:before {
    border-color: rgba(144, 164, 174, 0);
    border-width: 7px;
    margin-top: -7px;
    }

    .apexcharts-yaxistooltip-left:after,
    .apexcharts-yaxistooltip-left:before {
    left: 100%;
    }

    .apexcharts-yaxistooltip-right:after,
    .apexcharts-yaxistooltip-right:before {
    right: 100%;
    }

    .apexcharts-yaxistooltip-left:after {
    border-left-color: #ECEFF1;
    }

    .apexcharts-yaxistooltip-left:before {
    border-left-color: #90A4AE;
    }

    .apexcharts-yaxistooltip-left.apexcharts-theme-dark:after {
    border-left-color: rgba(0, 0, 0, 0.5);
    }

    .apexcharts-yaxistooltip-left.apexcharts-theme-dark:before {
    border-left-color: rgba(0, 0, 0, 0.5);
    }

    .apexcharts-yaxistooltip-right:after {
    border-right-color: #ECEFF1;
    }

    .apexcharts-yaxistooltip-right:before {
    border-right-color: #90A4AE;
    }

    .apexcharts-yaxistooltip-right.apexcharts-theme-dark:after {
    border-right-color: rgba(0, 0, 0, 0.5);
    }

    .apexcharts-yaxistooltip-right.apexcharts-theme-dark:before {
    border-right-color: rgba(0, 0, 0, 0.5);
    }

    .apexcharts-yaxistooltip.apexcharts-active {
    opacity: 1;
    }

    .apexcharts-yaxistooltip-hidden {
    display: none;
    }

    .apexcharts-xcrosshairs,
    .apexcharts-ycrosshairs {
    pointer-events: none;
    opacity: 0;
    transition: 0.15s ease all;
    }

    .apexcharts-xcrosshairs.apexcharts-active,
    .apexcharts-ycrosshairs.apexcharts-active {
    opacity: 1;
    transition: 0.15s ease all;
    }

    .apexcharts-ycrosshairs-hidden {
    opacity: 0;
    }

    .apexcharts-selection-rect {
    cursor: move;
    }

    .svg_select_boundingRect, .svg_select_points_rot {
    pointer-events: none;
    opacity: 0;
    visibility: hidden;
    }
    .apexcharts-selection-rect + g .svg_select_boundingRect,
    .apexcharts-selection-rect + g .svg_select_points_rot {
    opacity: 0;
    visibility: hidden;
    }

    .apexcharts-selection-rect + g .svg_select_points_l,
    .apexcharts-selection-rect + g .svg_select_points_r {
    cursor: ew-resize;
    opacity: 1;
    visibility: visible;
    }

    .svg_select_points {
    fill: #efefef;
    stroke: #333;
    rx: 2;
    }

    .apexcharts-svg.apexcharts-zoomable.hovering-zoom {
    cursor: crosshair
    }

    .apexcharts-svg.apexcharts-zoomable.hovering-pan {
    cursor: move
    }

    .apexcharts-zoom-icon,
    .apexcharts-zoomin-icon,
    .apexcharts-zoomout-icon,
    .apexcharts-reset-icon,
    .apexcharts-pan-icon,
    .apexcharts-selection-icon,
    .apexcharts-menu-icon,
    .apexcharts-toolbar-custom-icon {
    cursor: pointer;
    width: 20px;
    height: 20px;
    line-height: 24px;
    color: #6E8192;
    text-align: center;
    }

    .apexcharts-zoom-icon svg,
    .apexcharts-zoomin-icon svg,
    .apexcharts-zoomout-icon svg,
    .apexcharts-reset-icon svg,
    .apexcharts-menu-icon svg {
    fill: #6E8192;
    }

    .apexcharts-selection-icon svg {
    fill: #444;
    transform: scale(0.76)
    }

    .apexcharts-theme-dark .apexcharts-zoom-icon svg,
    .apexcharts-theme-dark .apexcharts-zoomin-icon svg,
    .apexcharts-theme-dark .apexcharts-zoomout-icon svg,
    .apexcharts-theme-dark .apexcharts-reset-icon svg,
    .apexcharts-theme-dark .apexcharts-pan-icon svg,
    .apexcharts-theme-dark .apexcharts-selection-icon svg,
    .apexcharts-theme-dark .apexcharts-menu-icon svg,
    .apexcharts-theme-dark .apexcharts-toolbar-custom-icon svg {
    fill: #f3f4f5;
    }

    .apexcharts-canvas .apexcharts-zoom-icon.apexcharts-selected svg,
    .apexcharts-canvas .apexcharts-selection-icon.apexcharts-selected svg,
    .apexcharts-canvas .apexcharts-reset-zoom-icon.apexcharts-selected svg {
    fill: #008FFB;
    }

    .apexcharts-theme-light .apexcharts-selection-icon:not(.apexcharts-selected):hover svg,
    .apexcharts-theme-light .apexcharts-zoom-icon:not(.apexcharts-selected):hover svg,
    .apexcharts-theme-light .apexcharts-zoomin-icon:hover svg,
    .apexcharts-theme-light .apexcharts-zoomout-icon:hover svg,
    .apexcharts-theme-light .apexcharts-reset-icon:hover svg,
    .apexcharts-theme-light .apexcharts-menu-icon:hover svg {
    fill: #333;
    }

    .apexcharts-selection-icon,
    .apexcharts-menu-icon {
    position: relative;
    }

    .apexcharts-reset-icon {
    margin-left: 5px;
    }

    .apexcharts-zoom-icon,
    .apexcharts-reset-icon,
    .apexcharts-menu-icon {
    transform: scale(0.85);
    }

    .apexcharts-zoomin-icon,
    .apexcharts-zoomout-icon {
    transform: scale(0.7)
    }

    .apexcharts-zoomout-icon {
    margin-right: 3px;
    }

    .apexcharts-pan-icon {
    transform: scale(0.62);
    position: relative;
    left: 1px;
    top: 0px;
    }

    .apexcharts-pan-icon svg {
    fill: #fff;
    stroke: #6E8192;
    stroke-width: 2;
    }

    .apexcharts-pan-icon.apexcharts-selected svg {
    stroke: #008FFB;
    }

    .apexcharts-pan-icon:not(.apexcharts-selected):hover svg {
    stroke: #333;
    }

    .apexcharts-toolbar {
    position: absolute;
    z-index: 11;
    max-width: 176px;
    text-align: right;
    border-radius: 3px;
    padding: 0px 6px 2px 6px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    }

    .apexcharts-menu {
    background: #fff;
    position: absolute;
    top: 100%;
    border: 1px solid #ddd;
    border-radius: 3px;
    padding: 3px;
    right: 10px;
    opacity: 0;
    min-width: 110px;
    transition: 0.15s ease all;
    pointer-events: none;
    }

    .apexcharts-menu.apexcharts-menu-open {
    opacity: 1;
    pointer-events: all;
    transition: 0.15s ease all;
    }

    .apexcharts-menu-item {
    padding: 6px 7px;
    font-size: 12px;
    cursor: pointer;
    }

    .apexcharts-theme-light .apexcharts-menu-item:hover {
    background: #eee;
    }

    .apexcharts-theme-dark .apexcharts-menu {
    background: rgba(0, 0, 0, 0.7);
    color: #fff;
    }

    @media screen and (min-width: 768px) {
    .apexcharts-canvas:hover .apexcharts-toolbar {
        opacity: 1;
    }
    }

    .apexcharts-datalabel.apexcharts-element-hidden {
    opacity: 0;
    }

    .apexcharts-pie-label,
    .apexcharts-datalabels,
    .apexcharts-datalabel,
    .apexcharts-datalabel-label,
    .apexcharts-datalabel-value {
    cursor: default;
    pointer-events: none;
    }

    .apexcharts-pie-label-delay {
    opacity: 0;
    animation-name: opaque;
    animation-duration: 0.3s;
    animation-fill-mode: forwards;
    animation-timing-function: ease;
    }

    .apexcharts-canvas .apexcharts-element-hidden {
    opacity: 0;
    }

    .apexcharts-hide .apexcharts-series-points {
    opacity: 0;
    }

    .apexcharts-gridline,
    .apexcharts-annotation-rect,
    .apexcharts-tooltip .apexcharts-marker,
    .apexcharts-area-series .apexcharts-area,
    .apexcharts-line,
    .apexcharts-zoom-rect,
    .apexcharts-toolbar svg,
    .apexcharts-area-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
    .apexcharts-line-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
    .apexcharts-radar-series path,
    .apexcharts-radar-series polygon {
    pointer-events: none;
    }


    /* markers */

    .apexcharts-marker {
    transition: 0.15s ease all;
    }

    @keyframes opaque {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
    }


    /* Resize generated styles */

    @keyframes resizeanim {
    from {
        opacity: 0;
    }
    to {
        opacity: 0;
    }
    }

    .resize-triggers {
    animation: 1ms resizeanim;
    visibility: hidden;
    opacity: 0;
    }

    .resize-triggers,
    .resize-triggers>div,
    .contract-trigger:before {
    content: " ";
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    overflow: hidden;
    }

    .resize-triggers>div {
    background: #eee;
    overflow: auto;
    }

    .contract-trigger:before {
    width: 200%;
    height: 200%;
    }
</style>

    </head>
    <body>
    <div class="grid-container">

      <!-- Header -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        <div class="header-left">
          <span>Welcome Admin!</span>
        </div>
        <div class="header-right flex items-center space-x-4">
  <a href="{{ url('/admin/products') }}" class="text-blue-600 hover:text-blue-800" title="Products">
    <span class="material-icons-outlined cursor-pointer">inventory_2</span>
  </a>

  <a href="{{ url('/admin/orders') }}" class="text-gray-700 hover:text-blue-600" title="Orders">
    <span class="material-icons-outlined cursor-pointer">shopping_cart</span>
  </a>

  <a href="{{ url('/admin/messages') }}" class="text-gray-700 hover:text-blue-600" title="Messages">
    <span class="material-icons-outlined cursor-pointer">notifications</span>
  </a>
</div>

      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <span class="material-icons-outlined">inventory</span> Salman Electric
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="{{ route('admin.dashboard') }}">
              <span class="material-icons-outlined">dashboard</span> Dashboard
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="{{ route('admin.products') }}">
              <span class="material-icons-outlined">inventory_2</span> Products
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="{{ route('admin.users') }}">
              <span class="material-icons-outlined">account_circle</span> Users
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="{{ route('admin.orders') }}">
              <span class="material-icons-outlined">add_shopping_cart</span> Pending Orders
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="{{ route('admin.stats') }}">
              <span class="material-icons-outlined">poll</span> Messages
            </a>
          </li>
        </ul>
      </aside>

      <!-- End Sidebar -->

      <!-- Main -->
      <main class="main-container">
              <div class="main-title">
                <p class="font-weight-bold">DASHBOARD</p>
              </div>

              <div class="main-cards">

          <div class="card">
              <div class="card-inner">
                  <p class="text-primary">PRODUCTS</p>
                  <span class="material-icons-outlined text-blue">inventory_2</span>
              </div>
              <span class="text-primary font-weight-bold">{{ $productCount }}</span>
          </div>

          <div class="card">
              <div class="card-inner">
                  <p class="text-primary">PURCHASE ORDERS</p>
                  <span class="material-icons-outlined text-orange">add_shopping_cart</span>
              </div>
              <span class="text-primary font-weight-bold">{{ $orderCount }}</span>
          </div>

          <div class="card">
              <div class="card-inner">
                  <p class="text-primary">REGISTERED USERS</p>
                  <span class="material-icons-outlined text-green">person</span>
              </div>
              <span class="text-primary font-weight-bold">{{ $userCount }}</span>
          </div>

          <div class="card">
              <div class="card-inner">
                  <p class="text-primary">MESSAGES</p>
                  <span class="material-icons-outlined text-red">notification_important</span>
              </div>
              <span class="text-primary font-weight-bold">{{ $messageCount }}</span>
          </div>
      </div>
      </main>
      <!-- End Main -->
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
<script src="{{ asset('js/scripts.js') }}"></script>


  <svg id="SvgjsSvg1213" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;"><defs id="SvgjsDefs1214"></defs><polyline id="SvgjsPolyline1215" points="0,0"></polyline><path id="SvgjsPath1216" d="M-1 264.99519938278195L-1 264.99519938278195C-1 264.99519938278195 69.14116207758586 264.99519938278195 69.14116207758586 264.99519938278195C69.14116207758586 264.99519938278195 138.28232415517172 264.99519938278195 138.28232415517172 264.99519938278195C138.28232415517172 264.99519938278195 207.42348623275757 264.99519938278195 207.42348623275757 264.99519938278195C207.42348623275757 264.99519938278195 276.56464831034344 264.99519938278195 276.56464831034344 264.99519938278195C276.56464831034344 264.99519938278195 345.70581038792926 264.99519938278195 345.70581038792926 264.99519938278195C345.70581038792926 264.99519938278195 414.84697246551514 264.99519938278195 414.84697246551514 264.99519938278195C414.84697246551514 264.99519938278195 414.84697246551514 264.99519938278195 414.84697246551514 264.99519938278195 "></path></svg>
</body></html>