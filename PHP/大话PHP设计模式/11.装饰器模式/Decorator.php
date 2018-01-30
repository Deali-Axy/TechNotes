<?php

/**
 * Interface Decorator 装饰器接口
 * 可以根据需要添加更多方法
 */
interface IDecorator
{
    function beforeDraw();

    function afterDraw();
}

class Textarea
{
    protected $decorators = array();

    function addDecorator(IDecorator $decorater)
    {
        $this->decorators[] = $decorater;
    }

    function beforeDraw()
    {
        foreach ($this->decorators as $decorator)
        {
            $decorator->beforeDraw();
        }
    }

    function afterDraw()
    {
        $decorators = array_reverse($this->decorators);

        foreach ($decorators as $decorator)
        {
            $decorator->afterDraw();
        }
    }

    function Draw()
    {
        $this->beforeDraw();

        echo "================================<br/>\n";

        echo "Textarea<br/>\n";

        echo "================================<br/>\n";

        $this->afterDraw();
    }
}

class ColorDecorator implements IDecorator
{
    protected $color;

    function __construct($color = 'mediumvioletred')
    {
        $this->color = $color;
    }

    function beforeDraw()
    {
        // TODO: Implement beforeDraw() method.
        echo "<div style='color: {$this->color};'>\n";
    }

    function afterDraw()
    {
        // TODO: Implement afterDraw() method.
        echo "</div>\n";
    }
}

class SizeDecorator implements IDecorator
{
    protected $size;

    function __construct($size = '20px')
    {
        $this->size = $size;
    }

    function beforeDraw()
    {
        // TODO: Implement beforeDraw() method.
        // TODO: Implement beforeDraw() method.
        echo "<div style='font-size: {$this->size};'>\n";
    }

    function afterDraw()
    {
        // TODO: Implement afterDraw() method.
        echo "</div>\n";
    }
}

$text = new Textarea();
$text->addDecorator(new SizeDecorator());
$text->addDecorator(new ColorDecorator());
$text->Draw();