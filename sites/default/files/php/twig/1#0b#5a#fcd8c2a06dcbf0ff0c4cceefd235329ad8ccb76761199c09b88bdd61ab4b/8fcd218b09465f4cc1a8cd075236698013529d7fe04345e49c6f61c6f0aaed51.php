<?php

/* core/modules/system/templates/breadcrumb.html.twig */
class __TwigTemplate_0b5afcd8c2a06dcbf0ff0c4cceefd235329ad8ccb76761199c09b88bdd61ab4b extends Twig_Template
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
        // line 12
        if ((isset($context["breadcrumb"]) ? $context["breadcrumb"] : null)) {
            // line 13
            echo "  <nav class=\"breadcrumb\" role=\"navigation\" aria-labelledby=\"system-breadcrumb\">
    <h2 id=\"system-breadcrumb\" class=\"visually-hidden\">";
            // line 14
            echo twig_render_var(t("Breadcrumb"));
            echo "</h2>
    <ol>
    ";
            // line 16
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["breadcrumb"]) ? $context["breadcrumb"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 17
                echo "      <li>";
                echo twig_drupal_escape_filter($this->env, (isset($context["item"]) ? $context["item"] : null), "html", null, true);
                echo "</li>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 19
            echo "    </ol>
  </nav>
";
        }
    }

    public function getTemplateName()
    {
        return "core/modules/system/templates/breadcrumb.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 17,  112 => 105,  104 => 101,  98 => 98,  95 => 97,  92 => 96,  86 => 93,  83 => 92,  80 => 91,  74 => 89,  72 => 88,  65 => 84,  62 => 83,  56 => 81,  42 => 19,  29 => 16,  60 => 38,  52 => 35,  47 => 34,  39 => 31,  51 => 32,  43 => 27,  34 => 23,  25 => 20,  23 => 68,  21 => 13,  77 => 58,  71 => 41,  66 => 54,  63 => 39,  57 => 51,  54 => 80,  48 => 76,  46 => 29,  41 => 32,  35 => 72,  26 => 25,  24 => 14,  40 => 73,  36 => 30,  32 => 22,  27 => 69,  22 => 19,  19 => 12,);
    }
}
