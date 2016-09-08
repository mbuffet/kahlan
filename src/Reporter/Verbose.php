<?php
namespace Kahlan\Reporter;


class Verbose extends Terminal
{
    /**
     * Callback called before any specs processing.
     *
     * @param array $args The suite arguments.
     */
    public function start($args)
    {
        parent::start($args);
        $this->write("\n");
    }

    /**
     * Callback called on a suite start.
     *
     * @param object $suite The suite instance.
     */
    public function suiteStart($suite = null)
    {
        $messages = $suite->messages();
        $message = end($messages);
        $this->write("{$message}\n", "b;");
        $this->_indent++;
    }

    /**
     * Callback called after a suite execution.
     *
     * @param object $suite The suite instance.
     */
    public function suiteEnd($suite = null)
    {
        $this->_indent--;
    }

    /**
     * Callback called after a spec execution.
     *
     * @param object $log The log object of the whole spec.
     */
    public function specEnd($log = null)
    {
        $this->_reportSpec($log);
    }

    /**
     * Callback called at the end of specs processing.
     *
     * @param object $summary The execution summary instance.
     */
    public function end($summary)
    {
        $this->write("\n\n");
        $this->_reportSummary($summary);
    }
}
