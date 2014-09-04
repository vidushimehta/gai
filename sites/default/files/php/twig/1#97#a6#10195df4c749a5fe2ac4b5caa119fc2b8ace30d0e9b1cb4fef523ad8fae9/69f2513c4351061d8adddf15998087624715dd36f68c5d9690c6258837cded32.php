<?php

/* core/modules/system/templates/form.html.twig */
class __TwigTemplate_97a610195df4c749a5fe2ac4b5caa119fc2b8ace30d0e9b1cb4fef523ad8fae9 extends Twig_Template
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
        // line 15
        echo "<form";
        echo twig_drupal_escape_filter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true);
        echo ">
  ";
        // line 16
        echo twig_drupal_escape_filter($this->env, (isset($context["children"]) ? $context["children"] : null), "html", null, true);
        echo "
</form>
";
    }

    public function getTemplateName()
    {
        return "core/modules/system/templates/form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 38,  52 => 35,  47 => 34,  39 => 31,  51 => 32,  43 => 27,  34 => 23,  25 => 20,  23 => 19,  21 => 17,  77 => 58,  71 => 41,  66 => 54,  63 => 39,  57 => 51,  54 => 36,  48 => 30,  46 => 29,  41 => 32,  35 => 44,  26 => 28,  24 => 16,  40 => 25,  36 => 30,  32 => 22,  27 => 21,  22 => 19,  19 => 15,);
    }
}
