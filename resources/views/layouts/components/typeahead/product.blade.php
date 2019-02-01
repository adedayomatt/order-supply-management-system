<script>
    jQuery(document).ready(function($) {
        // Set the Options for "Bloodhound" suggestion engine
        var engine = new Bloodhound({
            remote: {
                url: '{{route('search.product')}}?q=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        $("input.product-search").typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, 
        {
            source: engine.ttAdapter(),
            // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
            name: 'product-suggestions',

            templates: {
                empty:'<div class="list-group-item text-center"><i class="fa fa-exclamation-triangle"></i> No product found</div>',
                pending: '<div class="list-group-item text-center">searching...</div>',
                // header: '<div class="list-group-item text-center font-weight-bold">Tags ResultsFound:</div>',
                // footer: '<div class="list-group-item text-center">Footer Content</div>',
                suggestion: function (data) {
                    var bizURL = "{{url('/')}}/@"+data.business.slug;
                    var productURL = bizURL+"/product/"+data.slug;
                    var result = '<div class="list-group-item"><strong><a href="'+productURL+'">'+data.name+'</a></strong><div class="grey">';
                            result += '<div class="text-right"><span class="figure">N '+data.price+'</span></div>';
                            result += '<p>'+data.business.name+'<small class="ml-3"><a href="'+bizURL+'">@'+data.business.slug+'</a></small></p>';
                         result += '</div></div>';
                    return result;
            }
            }
        })
    }); 

</script>
