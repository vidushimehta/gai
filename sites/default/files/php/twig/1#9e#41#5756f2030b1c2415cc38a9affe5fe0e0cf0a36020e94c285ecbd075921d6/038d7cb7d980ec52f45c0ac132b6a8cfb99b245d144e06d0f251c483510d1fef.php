<?php

/* core/modules/system/templates/image.html.twig */
class __TwigTemplate_9e415756f2030b1c2415cc38a9affe5fe0e0cf0a36020e94c285ecbd075921d6 extends Twig_Template
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
        echo "<img";
        echo twig_drupal_escape_filter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true);
        echo " />
";
    }

    public function getTemplateName()
    {
        return "core/modules/system/templates/image.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  105 => 57,  98 => 55,  90 => 52,  84 => 50,  78 => 48,  75 => 47,  71 => 45,  68 => 44,  63 => 42,  61 => 41,  57 => 40,  54 => 38,  48 => 36,  46 => 35,  41 => 34,  37 => 33,  33 => 32,  28 => 31,  24 => 30,  19 => 14,);
    }
}
