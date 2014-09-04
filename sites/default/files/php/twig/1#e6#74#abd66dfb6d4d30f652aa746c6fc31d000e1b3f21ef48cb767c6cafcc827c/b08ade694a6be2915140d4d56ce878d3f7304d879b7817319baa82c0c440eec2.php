<?php

/* core/modules/system/templates/region.html.twig */
class __TwigTemplate_e674abd66dfb6d4d30f652aa746c6fc31d000e1b3f21ef48cb767c6cafcc827c extends Twig_Template
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
        // line 23
        if ((isset($context["content"]) ? $context["content"] : null)) {
            // line 24
            echo "  <div";
            echo twig_drupal_escape_filter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true);
            echo ">
    ";
            // line 25
            echo twig_drupal_escape_filter($this->env, (isset($context["content"]) ? $context["content"] : null), "html", null, true);
            echo "
  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "core/modules/system/templates/region.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 38,  52 => 35,  47 => 34,  39 => 31,  51 => 32,  43 => 27,  34 => 23,  25 => 20,  23 => 19,  21 => 24,  77 => 58,  71 => 41,  66 => 54,  63 => 39,  57 => 51,  54 => 36,  48 => 30,  46 => 29,  41 => 32,  35 => 44,  26 => 25,  24 => 16,  40 => 25,  36 => 30,  32 => 22,  27 => 21,  22 => 19,  19 => 23,);
    }
}
