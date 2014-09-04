<?php

/* core/modules/system/templates/status-messages.html.twig */
class __TwigTemplate_f0df4da401128180bf629a80b64df1a0c8d8aa546f12e463b8774df788f335dc extends Twig_Template
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
        // line 26
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["message_list"]) ? $context["message_list"] : null));
        foreach ($context['_seq'] as $context["type"] => $context["messages"]) {
            // line 27
            echo "  <div class=\"messages messages--";
            echo twig_drupal_escape_filter($this->env, (isset($context["type"]) ? $context["type"] : null), "html", null, true);
            echo "\" role=\"contentinfo\" aria-label=\"";
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["status_headings"]) ? $context["status_headings"] : null), (isset($context["type"]) ? $context["type"] : null), array(), "array"), "html", null, true);
            echo "\">
    ";
            // line 28
            if (((isset($context["type"]) ? $context["type"] : null) == "error")) {
                // line 29
                echo "      <div role=\"alert\">
    ";
            }
            // line 31
            echo "      ";
            if ($this->getAttribute((isset($context["status_headings"]) ? $context["status_headings"] : null), (isset($context["type"]) ? $context["type"] : null), array(), "array")) {
                // line 32
                echo "        <h2 class=\"visually-hidden\">";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["status_headings"]) ? $context["status_headings"] : null), (isset($context["type"]) ? $context["type"] : null), array(), "array"), "html", null, true);
                echo "</h2>
      ";
            }
            // line 34
            echo "      ";
            if ((twig_length_filter($this->env, (isset($context["messages"]) ? $context["messages"] : null)) > 1)) {
                // line 35
                echo "        <ul class=\"messages__list\">
          ";
                // line 36
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["messages"]) ? $context["messages"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                    // line 37
                    echo "            <li class=\"messages__item\">";
                    echo twig_drupal_escape_filter($this->env, (isset($context["message"]) ? $context["message"] : null), "html", null, true);
                    echo "</li>
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 39
                echo "        </ul>
      ";
            } else {
                // line 41
                echo "        ";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["messages"]) ? $context["messages"] : null), 0), "html", null, true);
                echo "
      ";
            }
            // line 43
            echo "    ";
            if (((isset($context["type"]) ? $context["type"] : null) == "error")) {
                // line 44
                echo "      </div>
    ";
            }
            // line 46
            echo "  </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['type'], $context['messages'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "core/modules/system/templates/status-messages.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 46,  68 => 41,  64 => 39,  55 => 37,  45 => 34,  30 => 28,  33 => 17,  112 => 105,  104 => 101,  98 => 98,  95 => 97,  92 => 96,  86 => 93,  83 => 92,  80 => 91,  74 => 43,  72 => 88,  65 => 84,  62 => 83,  56 => 81,  42 => 19,  29 => 16,  60 => 38,  52 => 35,  47 => 34,  39 => 32,  51 => 36,  43 => 27,  34 => 23,  25 => 20,  23 => 27,  21 => 13,  77 => 44,  71 => 41,  66 => 54,  63 => 39,  57 => 51,  54 => 80,  48 => 35,  46 => 29,  41 => 32,  35 => 72,  26 => 25,  24 => 14,  40 => 73,  36 => 31,  32 => 29,  27 => 69,  22 => 19,  19 => 26,);
    }
}
