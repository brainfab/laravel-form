<?php

namespace Brainfab\LaravelForm\Blade;

/**
 * Class BlockCompiler.
 */
class BlockCompiler
{
    /**
     * @var array
     */
    protected $blocks = [];

    /**
     * @param string   $name
     * @param callable $block
     */
    public function addBlock($name, callable $block)
    {
        $this->blocks[$name] = $block;
    }

    /**
     * @return array
     */
    public function getBlocks()
    {
        return $this->blocks;
    }

    /**
     * @return callable|null
     */
    public function getBlock($name)
    {
        return $this->blocks[$name];
    }

    /**
     * @return bool
     */
    public function hasBlock($name)
    {
        return isset($this->blocks[$name]);
    }

    /**
     * @param string $name
     * @param array  $data
     *
     * @return mixed
     */
    public function renderBlock($name, array $data = [])
    {
        if (!$this->hasBlock($name)) {
            throw new \RuntimeException(sprintf('Block "%s" not exists', $name));
        }

        return call_user_func($this->getBlock($name), $data);
    }

    /**
     * @param string $name
     * @param array  $data
     */
    public function yieldBlock($name, array $data = [])
    {
        echo $this->renderBlock($name, $data);
    }
}
