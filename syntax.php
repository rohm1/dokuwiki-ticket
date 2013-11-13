<?php
/**
 * DokuWiki Plugin ticket (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Romain Perez <rp@rohm1.com>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

class syntax_plugin_ticket extends DokuWiki_Syntax_Plugin
{

    /**
     * @return string Syntax mode type
     */
    public function getType()
    {
        return 'substition';
    }

    /**
     * @return int Sort order - Low numbers go before high numbers
     */
    public function getSort()
    {
        return 341;
    }

    /**
     * Connect lookup pattern to lexer.
     *
     * @param string $mode Parser mode
     */
    public function connectTo($mode)
    {
        $this->Lexer->addSpecialPattern(' #\d+ ', $mode, 'plugin_ticket');
    }

    /**
     * Handle matches of the ticket syntax
     *
     * @param string $match The match of the syntax
     * @param int    $state The state of the handler
     * @param int    $pos The position in the document
     * @param Doku_Handler    $handler The handler
     * @return array Data for the renderer
     */
    public function handle($match, $state, $pos, &$handler)
    {
        $ticket = substr(trim($match), 1);

        return array($ticket);
    }

    /**
     * Render xhtml output or metadata
     *
     * @param string         $mode      Renderer mode (supported modes: xhtml)
     * @param Doku_Renderer  $renderer  The renderer
     * @param array          $data      The data from the handler() function
     * @return bool If rendering was successful.
     */
    public function render($mode, &$renderer, $data)
    {
        if($mode != 'xhtml') return false;

        $renderer->doc .= ' <a href="' . sprintf($this->getConf('url'), $data[0]) . '" title="Ticket #' . $data[0] .'">#' . $data[0] .'</a> ';

        return true;
    }
}
