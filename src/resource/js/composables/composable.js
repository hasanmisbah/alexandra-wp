import { ElLoading  } from 'element-plus'

export function useLoading() {

    const loader = {

        instance: null,

        start(){

            if(!this.instance){
                ElLoading.service({
                    lock: true,
                    text: 'Loading...',
                    background: 'rgba(0, 0, 0, 0.7)',
                });
            }

        },

        stop(){
            if (this.instance) {
                this.instance.close();
            }
        }
    }

    return {
        loader
    }

}
