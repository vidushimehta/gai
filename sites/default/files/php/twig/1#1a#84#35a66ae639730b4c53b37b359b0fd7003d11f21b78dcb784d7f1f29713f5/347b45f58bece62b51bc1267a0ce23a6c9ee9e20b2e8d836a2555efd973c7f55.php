<?php

/* core/modules/system/templates/pager.html.twig */
class __TwigTemplate_1a8435a66ae639730b4c53b37b359b0fd7003d11f21b78dcb784d7f1f29713f5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 14
        if ((isset($context["items"]) ? $context["items"] : null)) {
            // line 15
            echo "  <h2 class=\"visually-hidden\">";
            echo twig_render_var(t("Pages"));
            echo "</h2>
  ";
            // line 16
            echo twig_drupal_escape_filter($this->env, (isset($context["items"]) ? $context["items"] : null), "html", null, true);
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "core/modules/system/templates/pager.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  26 => 16,  60 => 52,  57 => 50,  51 => 48,  47 => 47,  35 => 43,  25 => 41,  23 => 40,  21 => 15,  155 => 93,  149 => 90,  146 => 89,  143 => 88,  137 => 85,  134 => 84,  131 => 83,  125 => 81,  122 => 80,  116 => 77,  113 => 76,  110 => 75,  104 => 73,  102 => 72,  99 => 71,  93 => 68,  90 => 67,  84 => 64,  81 => 63,  79 => 62,  76 => 58,  70 => 56,  67 => 54,  64 => 56,  58 => 53,  55 => 49,  52 => 51,  46 => 48,  43 => 46,  41 => 46,  36 => 45,  30 => 43,  28 => 42,  24 => 41,  19 => 14,);
    }
}
