"use strict";function lockPage(){$(".b-main").innerHeight()<=$(window).innerHeight()?$page.css("padding-right","").addClass("no-scroll"):$page.css("padding-right",scrollWidth).addClass("no-scroll")}function unlockPage(){$page.removeClass("no-scroll").css("padding-right","")}var $body=$("body"),$page=$(".js-page-wrapper"),scrollWidth=function(){var i=$("<div>").css({height:"50px",width:"50px"}),n=$("<div>").css({height:"200px"});$body.append(i.append(n));var d=$("div",i).innerWidth();i.css("overflow-y","scroll");var e=$("div",i).innerWidth();return $(i).remove(),d-e};$(window).resize(function(){$(window).width()>=1366&&unlockPage()});
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInBhcnRpYWxzL3Njcm9sbC5qcyJdLCJuYW1lcyI6WyJsb2NrUGFnZSIsIiQiLCJpbm5lckhlaWdodCIsIndpbmRvdyIsIiRwYWdlIiwiY3NzIiwiYWRkQ2xhc3MiLCJzY3JvbGxXaWR0aCIsInVubG9ja1BhZ2UiLCJyZW1vdmVDbGFzcyIsIiRib2R5IiwiYmxvY2siLCJoZWlnaHQiLCJ3aWR0aCIsImluZGljYXRvciIsImFwcGVuZCIsIncxIiwiaW5uZXJXaWR0aCIsIncyIiwicmVtb3ZlIiwicmVzaXplIl0sIm1hcHBpbmdzIjoiQUFBQSxZQXFCQSxTQUFTQSxZQUNIQyxFQUFFLFdBQVdDLGVBQWlCRCxFQUFFRSxRQUFRRCxjQUMxQ0UsTUFBTUMsSUFBSSxnQkFBaUIsSUFBSUMsU0FBUyxhQUV4Q0YsTUFBTUMsSUFBSSxnQkFBaUJFLGFBQWFELFNBQVMsYUFJckQsUUFBU0UsY0FDUEosTUFBTUssWUFBWSxhQUFhSixJQUFJLGdCQUFpQixJQTVCdEQsR0FBSUssT0FBUVQsRUFBRSxRQUNWRyxNQUFRSCxFQUFFLG9CQUVWTSxZQUFjLFdBQ2hCLEdBQUlJLEdBQVFWLEVBQUUsU0FBU0ksS0FDckJPLE9BQVEsT0FDUkMsTUFBTyxTQUVMQyxFQUFZYixFQUFFLFNBQVNJLEtBQ3pCTyxPQUFRLFNBRVZGLE9BQU1LLE9BQU9KLEVBQU1JLE9BQU9ELEdBQzFCLElBQUlFLEdBQUtmLEVBQUUsTUFBT1UsR0FBT00sWUFDekJOLEdBQU1OLElBQUksYUFBYyxTQUN4QixJQUFJYSxHQUFLakIsRUFBRSxNQUFPVSxHQUFPTSxZQUV6QixPQURBaEIsR0FBRVUsR0FBT1EsU0FDRkgsRUFBS0UsRUFlZGpCLEdBQUVFLFFBQVFpQixPQUFPLFdBQ1huQixFQUFFRSxRQUFRVSxTQUFXLE1BQ3ZCTCIsImZpbGUiOiJwYXJ0aWFscy9zY3JvbGwuanMiLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcblxudmFyICRib2R5ID0gJCgnYm9keScpO1xudmFyICRwYWdlID0gJCgnLmpzLXBhZ2Utd3JhcHBlcicpO1xuXG52YXIgc2Nyb2xsV2lkdGggPSBmdW5jdGlvbiBzY3JvbGxiYXJXaWR0aCgpIHtcbiAgdmFyIGJsb2NrID0gJCgnPGRpdj4nKS5jc3Moe1xuICAgIGhlaWdodDogJzUwcHgnLFxuICAgIHdpZHRoOiAnNTBweCdcbiAgfSksXG4gICAgICBpbmRpY2F0b3IgPSAkKCc8ZGl2PicpLmNzcyh7XG4gICAgaGVpZ2h0OiAnMjAwcHgnXG4gIH0pO1xuICAkYm9keS5hcHBlbmQoYmxvY2suYXBwZW5kKGluZGljYXRvcikpO1xuICB2YXIgdzEgPSAkKCdkaXYnLCBibG9jaykuaW5uZXJXaWR0aCgpO1xuICBibG9jay5jc3MoJ292ZXJmbG93LXknLCAnc2Nyb2xsJyk7XG4gIHZhciB3MiA9ICQoJ2RpdicsIGJsb2NrKS5pbm5lcldpZHRoKCk7XG4gICQoYmxvY2spLnJlbW92ZSgpO1xuICByZXR1cm4gdzEgLSB3Mjtcbn07XG5cbmZ1bmN0aW9uIGxvY2tQYWdlKCkge1xuICBpZiAoJCgnLmItbWFpbicpLmlubmVySGVpZ2h0KCkgPD0gJCh3aW5kb3cpLmlubmVySGVpZ2h0KCkpIHtcbiAgICAkcGFnZS5jc3MoJ3BhZGRpbmctcmlnaHQnLCAnJykuYWRkQ2xhc3MoJ25vLXNjcm9sbCcpO1xuICB9IGVsc2Uge1xuICAgICRwYWdlLmNzcygncGFkZGluZy1yaWdodCcsIHNjcm9sbFdpZHRoKS5hZGRDbGFzcygnbm8tc2Nyb2xsJyk7XG4gIH1cbn1cblxuZnVuY3Rpb24gdW5sb2NrUGFnZSgpIHtcbiAgJHBhZ2UucmVtb3ZlQ2xhc3MoJ25vLXNjcm9sbCcpLmNzcygncGFkZGluZy1yaWdodCcsICcnKTtcbn1cblxuJCh3aW5kb3cpLnJlc2l6ZShmdW5jdGlvbiAoKSB7XG4gIGlmICgkKHdpbmRvdykud2lkdGgoKSA+PSAxMzY2KSB7XG4gICAgdW5sb2NrUGFnZSgpO1xuICB9XG59KTsiXX0=