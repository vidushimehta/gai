<?php

/* core/modules/block/templates/block.html.twig */
class __TwigTemplate_7dbb0d71cf8230320840eee69032d47d7f2bfea81bc8f3db8b9c6156a6795aca extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 44
        echo "<div";
        echo twig_drupal_escape_filter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true);
        echo ">
  ";
        // line 45
        echo twig_drupal_escape_filter($this->env, (isset($context["title_prefix"]) ? $context["title_prefix"] : null), "html", null, true);
        echo "
  ";
        // line 46
        if ((isset($context["label"]) ? $context["label"] : null)) {
            // line 47
            echo "    <h2";
            echo twig_drupal_escape_filter($this->env, (isset($context["title_attributes"]) ? $context["title_attributes"] : null), "html", null, true);
            echo ">";
            echo twig_drupal_escape_filter($this->env, (isset($context["label"]) ? $context["label"] : null), "html", null, true);
            echo "</h2>
  ";
        }
        // line 49
        echo "  ";
        echo twig_drupal_escape_filter($this->env, (isset($context["title_suffix"]) ? $context["title_suffix"] : null), "html", null, true);
        echo "

  <div";
        // line 51
        echo twig_drupal_escape_filter($this->env, (isset($context["content_attributes"]) ? $context["content_attributes"] : null), "html", null, true);
        echo ">
    ";
        // line 52
        $this->displayBlock('content', $context, $blocks);
        // line 55
        echo "  </div>
</div>
";
    }

    // line 52
    public function block_content($context, array $blocks = array())
    {
        // line 53
        echo "      ";
        echo twig_drupal_escape_filter($this->env, (isset($context["content"]) ? $context["content"] : null), "html", null, true);
        echo "
    ";
    }

    public function getTemplateName()
    {
        return "core/modules/block/templates/block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 52,  31 => 47,  20 => 44,  81 => 46,  68 => 41,  64 => 39,  55 => 37,  45 => 51,  30 => 28,  33 => 17,  112 => 105,  104 => 101,  98 => 98,  95 => 97,  92 => 96,  86 => 93,  83 => 92,  80 => 91,  74 => 43,  72 => 88,  65 => 84,  62 => 83,  56 => 81,  42 => 19,  29 => 46,  60 => 53,  52 => 35,  47 => 34,  39 => 49,  51 => 55,  43 => 27,  34 => 23,  25 => 45,  23 => 27,  21 => 13,  77 => 44,  71 => 41,  66 => 54,  63 => 39,  57 => 52,  54 => 80,  48 => 35,  46 => 29,  41 => 32,  35 => 72,  26 => 25,  24 => 14,  40 => 73,  36 => 31,  32 => 29,  27 => 69,  22 => 19,  19 => 26,);
    }
}
