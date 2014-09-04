<?php

/* core/modules/color/templates/color-scheme-form.html.twig */
class __TwigTemplate_05fddc349bde502c1dde1210731781dcee6d136a24796cef7a59c9d0c5a07710 extends Twig_Template
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
        // line 18
        echo "<div class=\"color-form clearfix\">
  ";
        // line 19
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "scheme"), "html", null, true);
        echo "
  <div id=\"palette\" class=\"clearfix\">
    ";
        // line 21
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "palette"), "html", null, true);
        echo "
  </div>
  ";
        // line 23
        echo twig_drupal_escape_filter($this->env, twig_without((isset($context["form"]) ? $context["form"] : null), "scheme", "palette"), "html", null, true);
        echo "
  <h2>";
        // line 24
        echo twig_render_var(t("Preview"));
        echo "</h2>
  ";
        // line 25
        echo twig_drupal_escape_filter($this->env, (isset($context["html_preview"]) ? $context["html_preview"] : null), "html", null, true);
        echo "
</div>
";
    }

    public function getTemplateName()
    {
        return "core/modules/color/templates/color-scheme-form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 25,  36 => 24,  32 => 23,  27 => 21,  22 => 19,  19 => 18,);
    }
}
