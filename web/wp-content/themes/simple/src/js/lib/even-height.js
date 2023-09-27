/**
 * Equalizes the height of a given group of elements, making them all
 * at least as big as the largest of the group (but not restricting future
 * expansion. You may optionally pass in a parent selector by which the
 * elements will be equalized (each instance of the group selector will be
 * given equal heights within their parent, rather than across all elements
 * matching that selector globally).
 * @param string group
 * @param string parent
 */
var equalHeight = function (group, parent) {
    parent = parent || "body";
    jQuery(parent).each(function () {
        tallest = 0;
        jQuery(this).find(group).each(function () {
            var $this = jQuery(this);

            thisHeight = $this.height();
            if ($this.css('box-sizing') === 'content-box') {
                if (thisHeight > tallest) {
                    tallest = thisHeight;
                }
            } else {
                thisPadding = Number($this.css('padding-top').replace('px', ''))
                    + Number($this.css('padding-bottom').replace('px', ''));

                if ((thisHeight + thisPadding) > tallest) {
                    tallest = thisHeight + thisPadding;
                }
            }
        });
        jQuery(this).find(group).css('min-height', tallest);
    });
};

var trim = function (x) {
    return x.replace(/^\s+|\s+$/gm, '');
}

exports.equalHeight = equalHeight;
exports.trim = trim;