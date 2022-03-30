"use strict";
$(".js-constructor-slider").each(function () {
    function r(r) {
        var t = $("html").hasClass("no-object-fit") ? s.find(".slick-active").data("slick-index") * -138 : Number($(".js-constructor-slider .slick-track").css("transform").split(", ")[4]),
            i = r ? $(".js-constructor-slider .slick-track").innerWidth() - 18 + t : $(".js-constructor-slider .slick-track").innerWidth() - 18,
            e = $(".js-constructor-slider").parent().innerWidth();
        i <= e ? s.parents(".b-constructor-slider__slider-wrap").addClass("visible") : s.parents(".b-constructor-slider__slider-wrap").removeClass("visible")
    }

    var s = $(this), t = s.parents(".b-constructor-slider__slider-wrap").find(".js-constructor-prev"),
        i = s.parents(".b-constructor-slider__slider-wrap").find(".js-constructor-next");
    s.on("init", r), s.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: !1,
        focusOnSelect: !1,
        infinite: !1,
        mobileFirst: !0,
        arrows: !0,
        prevArrow: t,
        nextArrow: i,
        swipe: !1,
        accessibility: !1
    }).on("beforeChange", function (r, s, t, i) {
        r.preventDefault();
        var e = $(".js-door-btn")[i].dataset.target;
        changeDoor(e)
    }).on("afterChange", function () {
        r(!0)
    }), $($(".js-door-target")[0]).show(), $(".js-door-btn").on("click", function () {
        var r = this.dataset.target;
        changeDoor(r)
    }), $(".js-color-radio-input").on("change", function () {
        var r = $(this).attr("id"), s = $(this).parent().parent().siblings();
        $(this).is(":checked") && (s.find("label").removeClass("active"), s.find('label[for="' + r + '"]').addClass("active"))
    }), $(window).on("resize", r)
});
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInBhcnRpYWxzL2NvbnN0cnVjdG9yLXNsaWRlci5qcyJdLCJuYW1lcyI6WyIkIiwiZWFjaCIsImNoZWNrVmlzaWJpbGl0eSIsImNoYW5nZSIsInRyYW5zZm9ybWF0aW9uIiwiaGFzQ2xhc3MiLCIkc2xpZGVyIiwiZmluZCIsImRhdGEiLCJOdW1iZXIiLCJjc3MiLCJzcGxpdCIsIndpZHRoVHJhY2siLCJpbm5lcldpZHRoIiwid2lkdGhTbGlkZXIiLCJwYXJlbnQiLCJwYXJlbnRzIiwiYWRkQ2xhc3MiLCJyZW1vdmVDbGFzcyIsInRoaXMiLCJwcmV2QXJyb3ciLCJuZXh0QXJyb3ciLCJvbiIsInNsaWNrIiwic2xpZGVzVG9TaG93Iiwic2xpZGVzVG9TY3JvbGwiLCJkb3RzIiwiZm9jdXNPblNlbGVjdCIsImluZmluaXRlIiwibW9iaWxlRmlyc3QiLCJhcnJvd3MiLCJzd2lwZSIsImFjY2Vzc2liaWxpdHkiLCJldmVudCIsImN1cnJlbnRTbGlkZSIsIm5leHRTbGlkZSIsInByZXZlbnREZWZhdWx0IiwiY3VycmVudERvb3IiLCJkYXRhc2V0IiwidGFyZ2V0IiwiY2hhbmdlRG9vciIsInNob3ciLCJpZCIsImF0dHIiLCIkbGFiZWxzV3JhcCIsInNpYmxpbmdzIiwiaXMiLCJ3aW5kb3ciXSwibWFwcGluZ3MiOiJBQUFBLFlBRUFBLEdBQUUsMEJBQTBCQyxLQUFLLFdBK0IvQixRQUFTQyxHQUFnQkMsR0FDdkIsR0FBSUMsR0FBaUJKLEVBQUUsUUFBUUssU0FBUyxpQkFBbUJDLEVBQVFDLEtBQUssaUJBQWlCQyxLQUFLLG9CQUF3QkMsT0FBT1QsRUFBRSx1Q0FBdUNVLElBQUksYUFBYUMsTUFBTSxNQUFNLElBQy9MQyxFQUFhVCxFQUFTSCxFQUFFLHVDQUF1Q2EsYUFBZSxHQUFLVCxFQUFpQkosRUFBRSx1Q0FBdUNhLGFBQWUsR0FDNUpDLEVBQWNkLEVBQUUsMEJBQTBCZSxTQUFTRixZQUVuREQsSUFBY0UsRUFDaEJSLEVBQVFVLFFBQVEsc0NBQXNDQyxTQUFTLFdBRS9EWCxFQUFRVSxRQUFRLHNDQUFzQ0UsWUFBWSxXQXRDdEUsR0FBSVosR0FBVU4sRUFBRW1CLE1BQ1pDLEVBQVlkLEVBQVFVLFFBQVEsc0NBQXNDVCxLQUFLLHdCQUN2RWMsRUFBWWYsRUFBUVUsUUFBUSxzQ0FBc0NULEtBQUssdUJBQzNFRCxHQUFRZ0IsR0FBRyxPQUFRcEIsR0FDbkJJLEVBQVFpQixPQUNOQyxhQUFjLEVBQ2RDLGVBQWdCLEVBQ2hCQyxNQUFNLEVBQ05DLGVBQWUsRUFDZkMsVUFBVSxFQUNWQyxhQUFhLEVBQ2JDLFFBQVEsRUFDUlYsVUFBV0EsRUFDWEMsVUFBV0EsRUFDWFUsT0FBTyxFQUNQQyxlQUFlLElBQ2RWLEdBQUcsZUFBZ0IsU0FBVVcsRUFBT1YsRUFBT1csRUFBY0MsR0FDMURGLEVBQU1HLGdCQUNOLElBQUlDLEdBQWNyQyxFQUFFLGdCQUFnQm1DLEdBQVdHLFFBQVFDLE1BQ3ZEQyxZQUFXSCxLQUNWZixHQUFHLGNBQWUsV0FDbkJwQixHQUFnQixLQUVsQkYsRUFBRUEsRUFBRSxtQkFBbUIsSUFBSXlDLE9BQzNCekMsRUFBRSxnQkFBZ0JzQixHQUFHLFFBQVMsV0FFNUIsR0FBSWUsR0FBY2xCLEtBQUttQixRQUFRQyxNQUMvQkMsWUFBV0gsS0FlYnJDLEVBQUUseUJBQXlCc0IsR0FBRyxTQUFVLFdBQ3RDLEdBQUlvQixHQUFLMUMsRUFBRW1CLE1BQU13QixLQUFLLE1BQ2xCQyxFQUFjNUMsRUFBRW1CLE1BQU1KLFNBQVNBLFNBQVM4QixVQUV4QzdDLEdBQUVtQixNQUFNMkIsR0FBRyxjQUNiRixFQUFZckMsS0FBSyxTQUFTVyxZQUFZLFVBQ3RDMEIsRUFBWXJDLEtBQUssY0FBZ0JtQyxFQUFLLE1BQU16QixTQUFTLGFBR3pEakIsRUFBRStDLFFBQVF6QixHQUFHLFNBQVVwQiIsImZpbGUiOiJwYXJ0aWFscy9jb25zdHJ1Y3Rvci1zbGlkZXIuanMiLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcblxuJCgnLmpzLWNvbnN0cnVjdG9yLXNsaWRlcicpLmVhY2goZnVuY3Rpb24gKCkge1xuICB2YXIgJHNsaWRlciA9ICQodGhpcyk7XG4gIHZhciBwcmV2QXJyb3cgPSAkc2xpZGVyLnBhcmVudHMoJy5iLWNvbnN0cnVjdG9yLXNsaWRlcl9fc2xpZGVyLXdyYXAnKS5maW5kKCcuanMtY29uc3RydWN0b3ItcHJldicpO1xuICB2YXIgbmV4dEFycm93ID0gJHNsaWRlci5wYXJlbnRzKCcuYi1jb25zdHJ1Y3Rvci1zbGlkZXJfX3NsaWRlci13cmFwJykuZmluZCgnLmpzLWNvbnN0cnVjdG9yLW5leHQnKTtcbiAgJHNsaWRlci5vbignaW5pdCcsIGNoZWNrVmlzaWJpbGl0eSk7XG4gICRzbGlkZXIuc2xpY2soe1xuICAgIHNsaWRlc1RvU2hvdzogMSxcbiAgICBzbGlkZXNUb1Njcm9sbDogMSxcbiAgICBkb3RzOiBmYWxzZSxcbiAgICBmb2N1c09uU2VsZWN0OiBmYWxzZSxcbiAgICBpbmZpbml0ZTogZmFsc2UsXG4gICAgbW9iaWxlRmlyc3Q6IHRydWUsXG4gICAgYXJyb3dzOiB0cnVlLFxuICAgIHByZXZBcnJvdzogcHJldkFycm93LFxuICAgIG5leHRBcnJvdzogbmV4dEFycm93LFxuICAgIHN3aXBlOiBmYWxzZSxcbiAgICBhY2Nlc3NpYmlsaXR5OiBmYWxzZVxuICB9KS5vbignYmVmb3JlQ2hhbmdlJywgZnVuY3Rpb24gKGV2ZW50LCBzbGljaywgY3VycmVudFNsaWRlLCBuZXh0U2xpZGUpIHtcbiAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgIHZhciBjdXJyZW50RG9vciA9ICQoJy5qcy1kb29yLWJ0bicpW25leHRTbGlkZV0uZGF0YXNldC50YXJnZXQ7XG4gICAgY2hhbmdlRG9vcihjdXJyZW50RG9vcik7XG4gIH0pLm9uKCdhZnRlckNoYW5nZScsIGZ1bmN0aW9uICgpIHtcbiAgICBjaGVja1Zpc2liaWxpdHkodHJ1ZSk7XG4gIH0pO1xuICAkKCQoJy5qcy1kb29yLXRhcmdldCcpWzBdKS5zaG93KCk7XG4gICQoJy5qcy1kb29yLWJ0bicpLm9uKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcbiAgICAvLyAkc2xpZGVyLnNsaWNrKCdzbGlja0dvVG8nLCAkKHRoaXMpLmRhdGEoJ3NsaWNrLWluZGV4JykpXG4gICAgdmFyIGN1cnJlbnREb29yID0gdGhpcy5kYXRhc2V0LnRhcmdldDtcbiAgICBjaGFuZ2VEb29yKGN1cnJlbnREb29yKTtcbiAgfSk7XG5cbiAgZnVuY3Rpb24gY2hlY2tWaXNpYmlsaXR5KGNoYW5nZSkge1xuICAgIHZhciB0cmFuc2Zvcm1hdGlvbiA9ICQoJ2h0bWwnKS5oYXNDbGFzcygnbm8tb2JqZWN0LWZpdCcpID8gJHNsaWRlci5maW5kKCcuc2xpY2stYWN0aXZlJykuZGF0YSgnc2xpY2staW5kZXgnKSAqIC0xMzggOiBOdW1iZXIoJCgnLmpzLWNvbnN0cnVjdG9yLXNsaWRlciAuc2xpY2stdHJhY2snKS5jc3MoJ3RyYW5zZm9ybScpLnNwbGl0KCcsICcpWzRdKTtcbiAgICB2YXIgd2lkdGhUcmFjayA9IGNoYW5nZSA/ICQoJy5qcy1jb25zdHJ1Y3Rvci1zbGlkZXIgLnNsaWNrLXRyYWNrJykuaW5uZXJXaWR0aCgpIC0gMTggKyB0cmFuc2Zvcm1hdGlvbiA6ICQoJy5qcy1jb25zdHJ1Y3Rvci1zbGlkZXIgLnNsaWNrLXRyYWNrJykuaW5uZXJXaWR0aCgpIC0gMTg7XG4gICAgdmFyIHdpZHRoU2xpZGVyID0gJCgnLmpzLWNvbnN0cnVjdG9yLXNsaWRlcicpLnBhcmVudCgpLmlubmVyV2lkdGgoKTtcblxuICAgIGlmICh3aWR0aFRyYWNrIDw9IHdpZHRoU2xpZGVyKSB7XG4gICAgICAkc2xpZGVyLnBhcmVudHMoJy5iLWNvbnN0cnVjdG9yLXNsaWRlcl9fc2xpZGVyLXdyYXAnKS5hZGRDbGFzcygndmlzaWJsZScpO1xuICAgIH0gZWxzZSB7XG4gICAgICAkc2xpZGVyLnBhcmVudHMoJy5iLWNvbnN0cnVjdG9yLXNsaWRlcl9fc2xpZGVyLXdyYXAnKS5yZW1vdmVDbGFzcygndmlzaWJsZScpO1xuICAgIH1cbiAgfVxuXG4gICQoJy5qcy1jb2xvci1yYWRpby1pbnB1dCcpLm9uKCdjaGFuZ2UnLCBmdW5jdGlvbiAoKSB7XG4gICAgdmFyIGlkID0gJCh0aGlzKS5hdHRyKCdpZCcpLFxuICAgICAgICAkbGFiZWxzV3JhcCA9ICQodGhpcykucGFyZW50KCkucGFyZW50KCkuc2libGluZ3MoKTtcblxuICAgIGlmICgkKHRoaXMpLmlzKCc6Y2hlY2tlZCcpKSB7XG4gICAgICAkbGFiZWxzV3JhcC5maW5kKCdsYWJlbCcpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcbiAgICAgICRsYWJlbHNXcmFwLmZpbmQoJ2xhYmVsW2Zvcj1cIicgKyBpZCArICdcIl0nKS5hZGRDbGFzcygnYWN0aXZlJyk7XG4gICAgfVxuICB9KTtcbiAgJCh3aW5kb3cpLm9uKCdyZXNpemUnLCBjaGVja1Zpc2liaWxpdHkpO1xufSk7Il19
