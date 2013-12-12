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

	const PATTERN_DEFAULT = '#\d+';
	const PATTERN_JIRA = '[A-Z]{1,10}\-[0-9]+';

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
        $this->Lexer->addSpecialPattern(self::PATTERN_DEFAULT, $mode, 'plugin_ticket');
        $this->Lexer->addSpecialPattern(self::PATTERN_JIRA, $mode, 'plugin_ticket');
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
        return array($match);
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

        if (preg_match('/^' . self::PATTERN_JIRA .'$/', $data[0])) {
            $renderer->doc .= '<a href="' . sprintf($this->getConf('jira_url'), $data[0]) . '"' . ($this->getConf('targetBlank') ? ' target="_blank"' : '') . ' title="Ticket ' . $data[0] .'">' . $data[0] .'</a>';
        } else {
            $data[0] = substr($data[0], 1);
            $renderer->doc .= '<a href="' . sprintf($this->getConf('url'), $data[0]) . '"' . ($this->getConf('targetBlank') ? ' target="_blank"' : '') . ' title="Ticket #' . $data[0] .'">#' . $data[0] .'</a>';
        }

        return true;
    }
}
