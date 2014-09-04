<?php

/* core/modules/system/templates/form-element-label.html.twig */
class __TwigTemplate_98b86457c3a6dc83ec231c7c05b281128993c8faa7693c5b105ad9ccf5349f22 extends Twig_Template
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
        // line 16
        if (((!twig_test_empty((isset($context["title"]) ? $context["title"] : null))) || (isset($context["required"]) ? $context["required"] : null))) {
            // line 17
            echo "<label";
            echo twig_drupal_escape_filter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true);
            echo ">";
            echo twig_drupal_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
            echo "</label>";
        }
    }

    public function getTemplateName()
    {
        return "core/modules/system/templates/form-element-label.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 17,  77 => 58,  71 => 55,  66 => 54,  63 => 53,  57 => 51,  54 => 50,  48 => 48,  46 => 47,  41 => 46,  35 => 44,  26 => 41,  24 => 40,  40 => 25,  36 => 24,  32 => 43,  27 => 21,  22 => 19,  19 => 16,);
    }
}
