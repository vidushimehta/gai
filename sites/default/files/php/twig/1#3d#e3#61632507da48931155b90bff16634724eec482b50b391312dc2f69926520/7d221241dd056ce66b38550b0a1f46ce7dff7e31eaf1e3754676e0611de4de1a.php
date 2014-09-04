<?php

/* core/modules/system/templates/menu-tree.html.twig */
class __TwigTemplate_3de361632507da48931155b90bff16634724eec482b50b391312dc2f69926520 extends Twig_Template
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
        if ((isset($context["tree"]) ? $context["tree"] : null)) {
            // line 30
            if ((isset($context["heading"]) ? $context["heading"] : null)) {
                // line 31
                if ($this->getAttribute((isset($context["heading"]) ? $context["heading"] : null), "level")) {
                    // line 32
                    echo "<";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["heading"]) ? $context["heading"] : null), "level"), "html", null, true);
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["heading"]) ? $context["heading"] : null), "attributes"), "html", null, true);
                    echo ">";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["heading"]) ? $context["heading"] : null), "text"), "html", null, true);
                    echo "</";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["heading"]) ? $context["heading"] : null), "level"), "html", null, true);
                    echo ">";
                } else {
                    // line 34
                    echo "<h2";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["heading"]) ? $context["heading"] : null), "attributes"), "html", null, true);
                    echo ">";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["heading"]) ? $context["heading"] : null), "text"), "html", null, true);
                    echo "</h2>";
                }
            }
            // line 37
            echo "<ul";
            echo twig_drupal_escape_filter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true);
            echo ">
    ";
            // line 38
            echo twig_drupal_escape_filter($this->env, (isset($context["tree"]) ? $context["tree"] : null), "html", null, true);
            echo "
  </ul>";
        }
    }

    public function getTemplateName()
    {
        return "core/modules/system/templates/menu-tree.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 38,  26 => 16,  60 => 52,  57 => 50,  51 => 48,  47 => 47,  35 => 34,  25 => 32,  23 => 31,  21 => 30,  155 => 93,  149 => 90,  146 => 89,  143 => 88,  137 => 85,  134 => 84,  131 => 83,  125 => 81,  122 => 80,  116 => 77,  113 => 76,  110 => 75,  104 => 73,  102 => 72,  99 => 71,  93 => 68,  90 => 67,  84 => 64,  81 => 63,  79 => 62,  76 => 58,  70 => 56,  67 => 54,  64 => 56,  58 => 53,  55 => 49,  52 => 51,  46 => 48,  43 => 37,  41 => 46,  36 => 45,  30 => 43,  28 => 42,  24 => 41,  19 => 29,);
    }
}
