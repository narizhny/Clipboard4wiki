<?php

if( !defined( 'MEDIAWIKI' ) ) {
    echo( "This is an extension to the MediaWiki package and cannot be run standalone.\n" );
    die( -1 );
}

$wgExtensionCredits['parser extensions'][] = array(
    'path'           => __FILE__,
    'name'           => 'Clipboard4wiki',
    'version'        => '4.0.0',
    'author'         => '',
    'url'            => '',
    'descriptionmsg' => 'Copy to clipboard. Js only, no flash.'
);

$wgClipboard4wikiPath = "$wgScriptPath/extensions/Clipboard4wiki";

$wgHooks['ParserFirstCallInit'][] = 'wfClipboard4wikiInit';

function wfClipboard4wikiInit( Parser $parser ) {
    global $wgOut, $wgJsMimeType, $wgClipboard4wikiPath;

    $parser->setHook( 'clippy', 'wfClipboard4wikiRender' );
    $wgOut->addScript("<script type=\"{$wgJsMimeType}\" src=\"$wgClipboard4wikiPath/clipboard4wiki.js\"></script>\n");
    $wgOut->addStyle("$wgClipboard4wikiPath/style.css", "screen");

    return true;
}

function wfClipboard4wikiRender( $input, array $args, Parser $parser, PPFrame $frame ) {
    global $wgClipboard4wikiPath;

    $link = htmlspecialchars($input);
    if(isset($args['show'])&& $args['show']== true) {
        $html = $link.'  ';
    } else {
        $html = '  ';
    }

    $html .= "<button class=\"btn\" tooltip=\"Copy\" onClick=\"clipboard4wiki('".str_replace(PHP_EOL, '\\n', $link)."')\" ><img src=\"$wgClipboard4wikiPath/clipboard.svg\" width=\"13\" /></button>";

    return $html;
}

