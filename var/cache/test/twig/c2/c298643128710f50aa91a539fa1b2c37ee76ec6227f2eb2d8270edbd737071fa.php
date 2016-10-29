<?php

/* AppBundle::base.html.twig */
class __TwigTemplate_1182b1c2e3b66a30408ce89cadcf0184bccecb26a62231bdd259d0f579ce238a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_87ce2777b5388eb3bf862e782741f2ec3066b84984473c236edc0810b100e3c5 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_87ce2777b5388eb3bf862e782741f2ec3066b84984473c236edc0810b100e3c5->enter($__internal_87ce2777b5388eb3bf862e782741f2ec3066b84984473c236edc0810b100e3c5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle::base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 12
        echo "    </body>
</html>
";
        
        $__internal_87ce2777b5388eb3bf862e782741f2ec3066b84984473c236edc0810b100e3c5->leave($__internal_87ce2777b5388eb3bf862e782741f2ec3066b84984473c236edc0810b100e3c5_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_90defa931ff42519a38d93c0994dfbb10eccf3b687c52550ca509a7736e26507 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_90defa931ff42519a38d93c0994dfbb10eccf3b687c52550ca509a7736e26507->enter($__internal_90defa931ff42519a38d93c0994dfbb10eccf3b687c52550ca509a7736e26507_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "AppBundle::base.html.twig"));

        echo "Welcome!";
        
        $__internal_90defa931ff42519a38d93c0994dfbb10eccf3b687c52550ca509a7736e26507->leave($__internal_90defa931ff42519a38d93c0994dfbb10eccf3b687c52550ca509a7736e26507_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_a28dcda6ef1540f7672e8b7b0d292bf52f2c6b6055b7be86a8863c51eca99b8a = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_a28dcda6ef1540f7672e8b7b0d292bf52f2c6b6055b7be86a8863c51eca99b8a->enter($__internal_a28dcda6ef1540f7672e8b7b0d292bf52f2c6b6055b7be86a8863c51eca99b8a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "AppBundle::base.html.twig"));

        
        $__internal_a28dcda6ef1540f7672e8b7b0d292bf52f2c6b6055b7be86a8863c51eca99b8a->leave($__internal_a28dcda6ef1540f7672e8b7b0d292bf52f2c6b6055b7be86a8863c51eca99b8a_prof);

    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
        $__internal_4e350721fd80c3db2092f8aa1d8fd34bfe108f81b4eaf39b17eabdf18cb66ebd = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_4e350721fd80c3db2092f8aa1d8fd34bfe108f81b4eaf39b17eabdf18cb66ebd->enter($__internal_4e350721fd80c3db2092f8aa1d8fd34bfe108f81b4eaf39b17eabdf18cb66ebd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "AppBundle::base.html.twig"));

        
        $__internal_4e350721fd80c3db2092f8aa1d8fd34bfe108f81b4eaf39b17eabdf18cb66ebd->leave($__internal_4e350721fd80c3db2092f8aa1d8fd34bfe108f81b4eaf39b17eabdf18cb66ebd_prof);

    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_df45b689e587c348ca269d6e0146c4298f87b44766cf3ce3ad041757d3d4a045 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_df45b689e587c348ca269d6e0146c4298f87b44766cf3ce3ad041757d3d4a045->enter($__internal_df45b689e587c348ca269d6e0146c4298f87b44766cf3ce3ad041757d3d4a045_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "AppBundle::base.html.twig"));

        
        $__internal_df45b689e587c348ca269d6e0146c4298f87b44766cf3ce3ad041757d3d4a045->leave($__internal_df45b689e587c348ca269d6e0146c4298f87b44766cf3ce3ad041757d3d4a045_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 11,  82 => 10,  71 => 6,  59 => 5,  50 => 12,  47 => 11,  45 => 10,  38 => 7,  36 => 6,  32 => 5,  26 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>{% block title %}Welcome!{% endblock %}</title>
        {% block stylesheets %}{% endblock %}
        <link rel=\"icon\" type=\"image/x-icon\" href=\"{{ asset('favicon.ico') }}\" />
    </head>
    <body>
        {% block body %}{% endblock %}
        {% block javascripts %}{% endblock %}
    </body>
</html>
", "AppBundle::base.html.twig", "/var/www/html/RO-WEB/src/AppBundle/Resources/views/base.html.twig");
    }
}
