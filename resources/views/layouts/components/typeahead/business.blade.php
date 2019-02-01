<script>
    jQuery(document).ready(function($) {
        // Set the Options for "Bloodhound" suggestion engine
        var engine = new Bloodhound({
            remote: {
                url: '{{route('search.business')}}?q=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        $("input.business-search").typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, 
        {
            source: engine.ttAdapter(),
            // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
            name: 'business-suggestions',

            templates: {
                empty:'<div class="list-group-item text-center"><i class="fa fa-exclamation-triangle"></i> No business found</div>',
                pending: '<div class="list-group-item text-center">searching...</div>',
                // header: '<div class="list-group-item text-center font-weight-bold">Results Found:</div>',
                // footer: '<div class="list-group-item text-center">Footer Content</div>',
                suggestion: function (data) {
                    var bizURL = "{{url('/')}}/@"+data.slug;
                    var result = '<div class="list-group-item"><h5><a href="'+bizURL+'">'+data.name+'</h5><div class="grey">';
                            result += '<small class="mr-3"><a href="'+bizURL+'#products">'+data.products.length+' products</a></small>';
                            result += '<small><a href="'+bizURL+'#services">'+data.services.length+' services</a></small>';
                         result += '</div></div>';
                    return result;
            }
            }
        })
    }); 

</script>
