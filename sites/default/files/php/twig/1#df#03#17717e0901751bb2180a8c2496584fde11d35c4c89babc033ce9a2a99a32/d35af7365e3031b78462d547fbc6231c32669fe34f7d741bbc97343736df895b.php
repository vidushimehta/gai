<?php

/* core/modules/system/templates/html.html.twig */
class __TwigTemplate_df0317717e0901751bb2180a8c2496584fde11d35c4c89babc033ce9a2a99a32 extends Twig_Template
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
        // line 29
        echo "<!DOCTYPE html>
<html";
        // line 30
        echo twig_drupal_escape_filter($this->env, (isset($context["html_attributes"]) ? $context["html_attributes"] : null), "html", null, true);
        echo ">
  <head>
    ";
        // line 32
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "head"), "html", null, true);
        echo "
    <title>";
        // line 33
        echo twig_drupal_escape_filter($this->env, (isset($context["head_title"]) ? $context["head_title"] : null), "html", null, true);
        echo "</title>
    ";
        // line 34
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "styles"), "html", null, true);
        echo "
    ";
        // line 35
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "scripts"), "html", null, true);
        echo "
  </head>
  <body";
        // line 37
        echo twig_drupal_escape_filter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true);
        echo ">
    <a href=\"#main-content\" class=\"visually-hidden focusable skip-link\">
      ";
        // line 39
        echo twig_render_var(t("Skip to main content"));
        echo "
    </a>
    ";
        // line 41
        echo twig_drupal_escape_filter($this->env, (isset($context["page_top"]) ? $context["page_top"] : null), "html", null, true);
        echo "
    ";
        // line 42
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "content"), "html", null, true);
        echo "
    ";
        // line 43
        echo twig_drupal_escape_filter($this->env, (isset($context["page_bottom"]) ? $context["page_bottom"] : null), "html", null, true);
        echo "
    ";
        // line 44
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "scripts", array(0 => "footer"), "method"), "html", null, true);
        echo "
  </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "core/modules/system/templates/html.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 42,  44 => 37,  49 => 39,  31 => 33,  20 => 44,  81 => 46,  68 => 41,  64 => 39,  55 => 37,  45 => 51,  30 => 28,  33 => 17,  112 => 105,  104 => 101,  98 => 98,  95 => 97,  92 => 96,  86 => 93,  83 => 92,  80 => 91,  74 => 43,  72 => 88,  65 => 84,  62 => 43,  56 => 81,  42 => 19,  29 => 46,  60 => 53,  52 => 35,  47 => 34,  39 => 35,  51 => 55,  43 => 27,  34 => 23,  25 => 45,  23 => 27,  21 => 13,  77 => 44,  71 => 41,  66 => 44,  63 => 39,  57 => 52,  54 => 41,  48 => 35,  46 => 29,  41 => 32,  35 => 34,  26 => 25,  24 => 14,  40 => 73,  36 => 31,  32 => 29,  27 => 32,  22 => 30,  19 => 29,);
    }
}
