<?php

/* core/modules/system/templates/system-themes-page.html.twig */
class __TwigTemplate_6cd507e54aff2a117ce17656fddec1fe013399a39e5fe58ccb54a62b6909244f extends Twig_Template
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
        echo "<div";
        echo twig_drupal_escape_filter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true);
        echo ">
  ";
        // line 30
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["theme_groups"]) ? $context["theme_groups"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["theme_group"]) {
            // line 31
            echo "    <div";
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["theme_group"]) ? $context["theme_group"] : null), "attributes"), "html", null, true);
            echo ">
      <h2>";
            // line 32
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["theme_group"]) ? $context["theme_group"] : null), "title"), "html", null, true);
            echo "</h2>
      ";
            // line 33
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["theme_group"]) ? $context["theme_group"] : null), "themes"));
            foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
                // line 34
                echo "        <div";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["theme"]) ? $context["theme"] : null), "attributes"), "html", null, true);
                echo ">
          ";
                // line 35
                if ($this->getAttribute((isset($context["theme"]) ? $context["theme"] : null), "screenshot")) {
                    // line 36
                    echo "            ";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["theme"]) ? $context["theme"] : null), "screenshot"), "html", null, true);
                    echo "
          ";
                }
                // line 38
                echo "          <div class=\"theme-info\">
            <h3>";
                // line 40
                echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["theme"]) ? $context["theme"] : null), "name"), "html", null, true);
                echo " ";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["theme"]) ? $context["theme"] : null), "version"), "html", null, true);
                // line 41
                if ($this->getAttribute((isset($context["theme"]) ? $context["theme"] : null), "notes")) {
                    // line 42
                    echo "                (";
                    echo twig_render_var(twig_drupal_join_filter($this->getAttribute((isset($context["theme"]) ? $context["theme"] : null), "notes"), ", "));
                    echo ")";
                }
                // line 44
                echo "</h3>
            <div class=\"theme-description\">";
                // line 45
                echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["theme"]) ? $context["theme"] : null), "description"), "html", null, true);
                echo "</div>
            ";
                // line 47
                echo "            ";
                if ($this->getAttribute((isset($context["theme"]) ? $context["theme"] : null), "incompatible")) {
                    // line 48
                    echo "              <div class=\"incompatible\">";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["theme"]) ? $context["theme"] : null), "incompatible"), "html", null, true);
                    echo "</div>
            ";
                } else {
                    // line 50
                    echo "              ";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["theme"]) ? $context["theme"] : null), "operations"), "html", null, true);
                    echo "
            ";
                }
                // line 52
                echo "          </div>
        </div>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['theme'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 55
            echo "    </div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['theme_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 57
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "core/modules/system/templates/system-themes-page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  105 => 57,  98 => 55,  90 => 52,  84 => 50,  78 => 48,  75 => 47,  71 => 45,  68 => 44,  63 => 42,  61 => 41,  57 => 40,  54 => 38,  48 => 36,  46 => 35,  41 => 34,  37 => 33,  33 => 32,  28 => 31,  24 => 30,  19 => 29,);
    }
}
