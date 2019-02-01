<script>
    jQuery(document).ready(function($) {
        // Set the Options for "Bloodhound" suggestion engine
        var engine = new Bloodhound({
            remote: {
                url: '{{route('search.tag')}}?q=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        $("input.tag-search").typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, 
        {
            source: engine.ttAdapter(),
            // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
            name: 'tag-suggestions',

            templates: {
                empty:'<div class="list-group-item text-center"><i class="fa fa-exclamation-triangle"></i> No tag found</div>',
                pending: '<div class="list-group-item text-center">searching...</div>',
                // header: '<div class="list-group-item text-center font-weight-bold">Tags Found:</div>',
                // footer: '<div class="list-group-item text-center">Footer Content</div>',
                suggestion: function (data) {
                    var tagURL = "{{url('/tag')}}/"+data.name;
                    var result = '<div class="list-group-item">'+data.name+'<div class="grey">';
                            result += '<small class="mr-3"><a href="'+tagURL+'#businesses">'+data.businesses.length+' businesses</a></small>';
                            result += '<small class="mr-3"><a href="'+tagURL+'#products">'+data.products.length+' products</a></small>';
                            result += '<small><a href="'+tagURL+'#services">'+data.services.length+' services</a></small>';
                         result += '</div></div>';
                    return result;
            }
            }
        }).bind('typeahead:select', function(ev, suggestion) {
            if($(this).attr('create') && $(this).attr('preview')){ //suggesting for a new post
                $(this).typeahead('val',''); //clear the values
                var tagsPreview = $($(this).attr('preview'));
                addTag(tagsPreview,suggestion);
            }
           else{
                $(this).typeahead('val',suggestion.name)
           }
        });
    }); 

    tagsSelected = 0;
        function addTag(container,tag){
            var tagID = 'tag-'+tag.name+'-'+tag.id;

            var tagContainer = $('<span>').attr({
                    class: 'tag',
                    id: tagID
                });
                
                var tagInput = $('<input>').attr({
                    type: 'hidden',
                    name: 'tags[]',
                    value: tag.id
                });


                var tag = $('<span>').attr({
                    class: '',
                }).text(tag.name);

                var tagRemover = $('<span>').attr({
                    class: 'float-right closer',
                    remove: tagID
                }).html('&times');
                

                tagContainer.append(tag,tagRemover,tagInput);
                container.append(tagContainer);
                tagsSelected++;
                container.find('#tags-counter').text(tagsSelected+' tag'+(tagsSelected > 1 ? 's' : '')+' selected');

                container.on('click','[remove = "'+tagID+'"]', function(e){
                    container.find('#'+tagID).remove();
                    tagsSelected--;
                    container.find('#tags-counter').text(tagsSelected+' tag'+(tagsSelected > 1 ? 's' : '')+' selected');
                })
        }


</script>
